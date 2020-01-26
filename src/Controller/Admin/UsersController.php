<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Cache\Cache;
use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @property \App\Controller\Component\PasswordComponent $Password
 */
class UsersController extends AppController
{
    use MailerAwareTrait;

    /**
     * Setup the User Search Config
     *
     * @return void
     *
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index', 'lookup'],
        ]);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        /** @var \App\Model\Entity\Section $section */
        $section = $this->Users->Sections->get($this->Auth->user('section_id'));

        $query = $this->Users
            ->find('search', ['search' => $this->request->getQueryParams()])
            ->contain(['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes', 'AuthRoles'])
            ->where([
                'SectionTypes.id' => $section->section_type_id,
                'AuthRoles.user_access' => true,
            ]);

        $this->set('users', $this->paginate($query));

        $this->paginate = [
            'contain' => ['Roles', 'Sections.Scoutgroups', 'Sections.SectionTypes'],
            'order' => ['last_login' => 'DESC'],
            'conditions' => ['SectionTypes.id' => $section->section_type_id],
        ];
        //$this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);

        $sections = $this->Users->Sections->find(
            'list',
            [
                    'keyField' => 'id',
                    'valueField' => 'section',
                    'groupField' => 'scoutgroup.district.district',
            ]
        )
            ->where(['section_type_id' => $section['section_type_id']])
            ->contain(['Scoutgroups.Districts']);
        $roles = $this->Users->Roles->find('leaders')->find('list');
        $authRoles = $this->Users->AuthRoles->find('list');
        $this->set(compact('sections', 'roles', 'authRoles'));
    }

    /**
     * View method
     *
     * @param string|null $userId User id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($userId = null)
    {
        $user = $this->Users->get($userId, [
            'contain' => ['Roles',
                'Sections.Scoutgroups',
                'Applications' => ['Sections.Scoutgroups', 'Events'],
                'Attendees' => ['Sections.Scoutgroups', 'Roles', 'sort' => ['role_id' => 'ASC', 'lastname' => 'ASC']],
                'Invoices.Applications.Events',
                'AuthRoles',
                'Notes' => ['Invoices', 'Applications'],
                'Notifications' => ['NotificationTypes', 'sort' => ['read_date' => 'DESC', 'created' => 'DESC']],
                'Reservations' => ['Events', 'ReservationStatuses', 'Attendees'],
            ],
        ]);

        $numOSM = $this->Users->Attendees->find('osm')->where(['user_id' => $user->id])->count();

        $this->set(compact('user', 'numOSM'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response Redirects on successful add, renders view otherwise.
     *
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
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
                    'postcode',
                ],
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
                    'groupField' => 'scoutgroup.district.district',
                ]
        )
            ->contain(['Scoutgroups.Districts']);
        $this->set(compact('user', 'roles', 'sections', 'auth_roles'));
        $this->set('_serialize', ['user']);
    }

    // use MailerAwareTrait;

    /**
     * Create & Sync the User Attendee and the User
     *
     * @param int $userId The ID of the User
     *
     * @return bool
     */
    private function syncUser($userId)
    {
        $user = $this->Users->get($userId);

        $attRef = $this->Users->Attendees->find('all')->where([
            'user_attendee' => true,
            'user_id' => $user->id,
        ]);
        $attName = $this->Users->Attendees->find('all')->where([
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'user_id' => $user->id,
        ]);

        $count = max($attRef->count(), $attName->count());

        if ($count == 1) {
            if ($attRef->count() == 1) {
                $att = $attRef->first();
            } else {
                $att = $attName->first();
            }
        } else {
            $att = $this->Users->Attendees->newEntity();
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
            'phone' => $user->phone,
        ];

        $att = $this->Users->Attendees->patchEntity($att, $attendeeData);

        if ($this->Users->Attendees->save($att)) {
            return true;
        }

        return false;
    }

    /**
     * Create & Sync the User Attendee and the User
     *
     * @param int $userId The ID of the User
     *
     * @return \Cake\Http\Response|null
     */
    public function sync($userId)
    {
        $syncResponse = $this->syncUser($userId);

        if ($syncResponse) {
            $this->Flash->success(__('An Attendee for the User has been Syncronised.'));
        } else {
            $this->Flash->error(__('An Attendee for the User could not be Syncronised. Please, try again.'));
        }

        return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view', $userId]);
    }

    /**
     * loop through all Users
     *
     * @return \Cake\Http\Response|null
     */
    public function syncAll()
    {
        $usersToSync = $this->Users->find('all');

        $success = 0;
        $error = 0;

        foreach ($usersToSync as $userAll) {
            $syncResponse = $this->syncUser($userAll->id);

            if ($syncResponse) {
                $success += 1;
            } else {
                $error += 1;
            }
        }
        $this->Flash->error('There were ' . $error . ' Syncronisation Errors.');
        $this->Flash->success($success . ' Users were Syncronised.');

        return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param int $userId The ID of the User to be Edited.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     *
     * @SuppressWarnings(PHPMD.CamelCaseVariableName)
     */
    public function edit($userId = null)
    {
        $user = $this->Users->get($userId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

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
        $auth_roles = $this->Users->AuthRoles->find('list');
        $sections = $this->Users->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.scoutgroup',
            ]
        )
            ->contain(['Scoutgroups']);
        $this->set(compact('user', 'roles', 'sections', 'auth_roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Reset a User's Password
     *
     * @param int $userId The ID of the User
     *
     * @return \Cake\Http\Response|null
     *
     * @throws \Exception
     */
    public function reset($userId)
    {
        $this->loadComponent('Password');

        if ($this->Password->sendReset($userId)) {
            $this->Flash->success('User Reset Email Sent.');

            return $this->redirect($this->referer(['controller' => 'Users', 'action' => 'view', $userId]));
        }

        $this->Flash->error('Reset Email could not be sent.');

        return $this->redirect($this->referer(['controller' => 'Users', 'action' => 'view', $userId]));
    }

    /**
     * Delete method
     *
     * @param string|null $userId User id.
     * @return \Cake\Http\Response Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($userId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($userId);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login for Admin
     *
     * @return \Cake\Http\Response|null
     */
    public function login()
    {
        return $this->redirect([
            'controller' => 'Users',
            'action' => 'login',
            'prefix' => false,
        ]);
    }

    /**
     * Log the User Out
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        $this->Flash->success('You are now logged out.');

        return $this->redirect($this->Auth->logout());
    }
}
