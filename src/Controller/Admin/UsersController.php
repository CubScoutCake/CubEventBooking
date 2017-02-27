<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\MailerAwareTrait;
use Cake\I18n\Time;
use Cake\Http\ServerRequest;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Cache\Cache;

//use DataTables\Controller\Component;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    use MailerAwareTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'lookup']
        ]);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Sections = TableRegistry::get('Sections');
        $section = $this->Sections->get($this->Auth->user('section_id'));

        $query = $this->Users
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes', 'AuthRoles'])
            ->where(['SectionTypes.id' => $section['section_type_id']]);

        $this->set('users', $this->paginate($query));

        $this->paginate = [
            'contain' => ['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes'],
            'order' => ['last_login' => 'DESC'],
            'conditions' => ['SectionTypes.id' => $section['section_type_id']]
        ];
        //$this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);

        $sections = $this->Users->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.district.district'
            ]
        )->contain(['Scoutgroups.Districts']);
        $roles = $this->Users->Roles->find('leaders')->find('list');
        $auth_roles = $this->Users->AuthRoles->find('list');
        $this->set(compact('sections', 'roles', 'auth_roles'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void|path
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles'
                , 'Sections.Scoutgroups'
                , 'Applications' => ['Sections.Scoutgroups', 'Events']
                , 'Attendees' => ['Sections.Scoutgroups', 'Roles', 'sort' => ['role_id' => 'ASC', 'lastname' => 'ASC']]
                , 'Invoices.Applications.Events'
                , 'AuthRoles'
                , 'Notes' => ['Invoices' , 'Applications']
                , 'Notifications' => ['NotificationTypes', 'sort' => ['read_date' => 'DESC', 'created' => 'DESC']]
            ]
        ]);

        $atts = TableRegistry::get('Attendees');

        $numOSM = $atts->find('osm')->where(['user_id' => $user->id])->count();

        $this->set(compact('user', 'numOSM'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data, [
                'fieldList' => [
                    'id',
                    'role_id',
                    'section_id',
                    'auth_role_id',
                    'firstname',
                    'lastname',
                    'username',
                    'membership_number',
                    'email',
                    'password',
                    'phone',
                    'address_1',
                    'address_2',
                    'city',
                    'county',
                    'postcode'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'view', $user->get('id')]);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('leaders')->find('list', ['limit' => 200]);
        $auth_roles = $this->Users->AuthRoles->find('list')->where(['super_user' => false]);
        $sections = $this->Users->Sections->find(
            'list',
            [
                    'keyField' => 'id',
                    'valueField' => 'section',
                    'groupField' => 'scoutgroup.district.district'
                ]
        )
            ->contain(['Scoutgroups.Districts']);
        $this->set(compact('user', 'roles', 'sections', 'auth_roles'));
        $this->set('_serialize', ['user']);
    }

    // use MailerAwareTrait;

    public function sync($userId)
    {

        $user = $this->Users->get($userId);

        $atts = TableRegistry::get('Attendees');

        $attRef = $atts->find('all')->where(['user_attendee' => true, 'user_id' => $user->id]);
        $attName = $atts->find('all')->where(['firstname' => $user->firstname, 'lastname' => $user->lastname, 'user_id' => $user->id]);

        $count = MAX($attRef->count(), $attName->count());

        if ($count == 1) {
            if ($attRef->count() == 1) {
                $att = $attRef->first();
            } else {
                $att = $attName->first();
            }
        } else {
            $newAttendeeData = ['dateofbirth' => '1990-01-01'];
            $att = $atts->newEntity($newAttendeeData);
        }

        $attendeeData = [
            'user_id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'address_1' => $user->address_1,
            'address_2' => $user->address_2,
            'city' => $user->city,
            'county' => $user->county,
            'user_attendee' => true,
            'postcode' => $user->postcode,
            'role_id' => $user->role_id,
            'section_id' => $user->section_id,
            'phone' => $user->phone
        ];

        $att = $atts->patchEntity($att, $attendeeData);

        if ($atts->save($att)) {
            $this->Flash->success(__('An Attendee for the User has been Syncronised.'));
        } else {
            $this->Flash->error(__('An Attendee for the User could not be Syncronised. Please, try again.'));
        }

        return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view', $user->id]);
    }

    public function syncAll()
    {

        $usrs = $this->Users->find('all');

        $success = 0;
        $error = 0;

        foreach ($usrs as $userAll) {
            $user = $this->Users->get($userAll->id);

            $atts = TableRegistry::get('Attendees');

            $attRef = $atts->find('all')->where(['user_attendee' => true, 'user_id' => $user->id]);
            $attName = $atts->find('all')->where(['firstname' => $user->firstname, 'lastname' => $user->lastname, 'user_id' => $user->id]);

            $count = MAX($attRef->count(), $attName->count());

            if ($count == 1) {
                if ($attRef->count() == 1) {
                    $att = $attRef->first();
                } else {
                    $att = $attName->first();
                }
            } else {
                $newAttendeeData = ['dateofbirth' => '1990-01-01'];
                $att = $atts->newEntity($newAttendeeData);
            }

            $attendeeData = [
                'user_id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'address_1' => $user->address_1,
                'address_2' => $user->address_2,
                'city' => $user->city,
                'county' => $user->county,
                'user_attendee' => true,
                'postcode' => $user->postcode,
                'role_id' => $user->role_id,
                'section_id' => $user->section_id,
                'phone' => $user->phone
            ];

            $att = $atts->patchEntity($att, $attendeeData);

            if ($atts->save($att)) {
                $success = $success + 1;
            } else {
                $error = $error + 1;
            }
        }
        $this->Flash->error('There were ' . $error . ' Syncronisation Errors.');
        $this->Flash->success($success . ' Users were Syncronised.');

        return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                if ($this->Auth->user('id') == $user->id) {
                    $this->Auth->setUser($user->toArray());
                    $this->Flash->success(__('Your login session has been refreshed.'));
                    Cache::clear(true);
                }

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $authRoles = $this->Users->AuthRoles->find('list');
        $sections = $this->Users->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.scoutgroup'
            ]
        )
            ->contain(['Scoutgroups']);
        $this->set(compact('user', 'roles', 'sections', 'auth_roles'));
        $this->set('_serialize', ['user']);
    }

    public function update($id = null)
    {
        $user = $this->Users->get($id);

        $upperUser = ['firstname' => ucwords(strtolower($user->firstname))
            , 'lastname' => ucwords(strtolower($user->lastname))
            , 'address_1' => ucwords(strtolower($user->address_1))
            , 'address_2' => ucwords(strtolower($user->address_2))
            , 'city' => ucwords(strtolower($user->city))
            , 'county' => ucwords(strtolower($user->county))
            , 'postcode' => strtoupper($user->postcode)
            , 'section' => ucwords(strtolower($user->section))];

        $user = $this->Users->patchEntity($user, $upperUser);

        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been updated.'));

            return $this->redirect(['action' => 'view', $user->id]);
        } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));

            return $this->redirect(['action' => 'view', $user->id]);
        }
    }

    public function reset($userId)
    {
        $sets = TableRegistry::get('Settings');

        $user = $this->Users->get($userId);

        $now = Time::now();

        $rMax = $sets->get(16)->text;
        $rMin = $sets->get(17)->text;

        $random = rand($rMin, $rMax);

        $string = 'Reset Success' . ( $user->id * $now->day ) . $random . $now->year . $now->month;

        $token = Security::hash($string);

        $newToken = ['reset' => $token];

        $user = $this->Users->patchEntity($user, $newToken);

        if ($this->Users->save($user)) {
            $this->getMailer('User')->send('passres', [$user, $random]);

            $this->Flash->success(__('A Password Reset was generated.'));

            return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view', $userId]);
        } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        return $this->redirect([
            'controller' => 'Users',
            'action' => 'login',
            'prefix' => false
        ]);
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');

        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['register']);
        $this->Auth->allow(['login']);
    }
}
