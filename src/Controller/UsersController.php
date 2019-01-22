<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\PasswordForm;
use App\Form\ResetForm;

use Cake\I18n\Time;
// use Cake\Utility\Hash;
use Cake\Network\Http\Client;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Controller\Component\ProgressComponent $Progress
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles', 'Sections.Scoutgroups']
        ];
        $this->paginate['conditions'] = [
            'section_id' => $this->Auth->user('section_id')
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $userID User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($userID = null)
    {
        $user = $this->Users->get($userID, [
            'contain' => ['Roles',
                'Sections.Scoutgroups',
                'Invoices.Applications',
                'Applications.Sections.Scoutgroups',
                'Applications.Events',
                'Attendees' => [
                    'Sections.Scoutgroups',
                    'Roles'
                ],
                'Notes' => ['conditions' => ['visible' => true]],
                'Notifications.NotificationTypes'
            ]
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $userID User id.
     *
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($userID = null)
    {
        $user = $this->Users->get($userID, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'sync']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('nonAuto')->find('leaders')->find('list', ['limit' => 200]);
        $sections = $this->Users->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'section',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $this->set(compact('user', 'roles', 'sections'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Sync Function
     *
     * @return \Cake\Network\Response|null
     */
    public function sync()
    {

        $user = $this->Users->get($this->Auth->user('id'));

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
            $att = $atts->newEntity();
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
            $this->Flash->success(__('An Attendee for your User has been Synchronised.'));
        } else {
            $this->Flash->error(__('An Attendee for your User could not be Synchronised. Please, try again.'));
            $this->log('Attendees:SYNC User:' . $user->id . ' Sync Error', 'notice');
        }

        return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
    }

    /**
     * Login method
     *
     * @return \Cake\Network\Response If Successful - redirects to landing.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function login()
    {
        // Set the layout.
        $this->viewBuilder()->layout('outside');

        $session = $this->request->session();

        if ($session->check('Reset.lgTries')) {
            $tries = $session->read('Reset.lgTries');
        }

        if (!isset($tries)) {
            $tries = 0;
        }

        if (isset($tries) && $tries > 10) {
            $this->Flash->error('You have failed entry too many times. Please try again later.');

            return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'reset']);
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                $userId = $this->Auth->user('id');

                $loggedInUser = $this->Users->get($userId, ['contain' => 'AuthRoles']);

                $now = Time::now();

                $logins = 1;
                $previousLogin = $now;
                $syncRedir = 1;

                if (!empty($loggedInUser->logins)) {
                    $logins = $loggedInUser->logins + 1;
                    $previousLogin = $loggedInUser->last_login;
                    $syncRedir = 0;
                }

                $loginPass = ['last_login' => $now, 'logins' => $logins, 'pw_salt' => $this->request->getQuery('redirect')];

                $loginEnt = [
                    'Entity Id' => $loggedInUser->id,
                    'Controller' => 'Users',
                    'Action' => 'Login',
                    'User Id' => $loggedInUser->id,
                    'Creation Date' => $loggedInUser->created,
                    'Modified' => $loggedInUser->modified,
                    'User' => [
                        'AuthValue' => $loggedInUser->auth_role->auth_value,
                        'Username' => $loggedInUser->username,
                        'First Name' => $loggedInUser->firstname,
                        'Last Name' => $loggedInUser->lastname,
                        'Number of Logins' => $logins,
                        'Previous Login' => $previousLogin,
                        'This Login' => $now
                        ]
                    ];

                $loggedInUser = $this->Users->patchEntity($loggedInUser, $loginPass, ['validate' => false]);
                $loggedInUser->setDirty('modified', true);

                if ($this->Users->save($loggedInUser)) {
                    $sets = TableRegistry::get('Settings');

                    $jsonLogin = json_encode($loginEnt);
                    $apiKey = $sets->get(13)->text;
                    $projectId = $sets->get(14)->text;
                    $eventType = 'Login';

                    $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                    $http = new Client();
                    $response = $http->post(
                        $keenURL,
                        $jsonLogin,
                        ['type' => 'json']
                    );

                    $this->loadComponent('Progress');

                    $this->Progress->cacheApps($loggedInUser->id);

                    $session->delete('Reset.lgTries');
                    $session->delete('Reset.rsTries');

                    if (!empty($this->request->getQuery('redirect'))) {
                        return $this->redirect($this->request->getQuery('redirect'));
                    }

                    if (!empty($this->request->getQueryParams())) {
                        return $this->redirect($this->request->getQueryParams());
                    }

                    if ($syncRedir == 1) {
                        return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'sync']);
                    }

                    $superBinary = 1 . 0 . 0 . 1 . 0; // Redirect SuperUsers

                    if ($loggedInUser->auth_role->auth_value >= bindec($superBinary)) {
                        return $this->redirect(['prefix' => 'super_user', 'controller' => 'Landing', 'action' => 'super_user_home']);
                    }

                    $adminBinary = 0 . 1 . 0 . 1 . 0; // Redirect Admins

                    if ($loggedInUser->auth_role->auth_value >= bindec($adminBinary)) {
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Landing', 'action' => 'admin_home']);
                    }

                    $champBinary = 0 . 0 . 1 . 1 . 0; // Redirect Champions

                    if ($loggedInUser->auth_role->auth_value >= bindec($champBinary)) {
                        return $this->redirect(['prefix' => 'champion', 'controller' => 'Landing', 'action' => 'champion_home']);
                    }

                    return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'user_home']);
                }

                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            $tries = $tries + 1;
            $this->Flash->error('Your username or password is incorrect. Please try again.');
            $session->write('Reset.lgTries', $tries);
        }
        $this->set(compact('eventId'));
    }

    /**
     * Password Reset Function - Enables Resetting a User's Password via Email
     *
     * @return \Cake\Network\Response|null
     */
    public function reset()
    {
        $this->viewBuilder()->setLayout('outside');

        $resForm = new ResetForm();
        $sets = TableRegistry::get('Settings');

        $scoutgroups = $this->Users->Sections->Scoutgroups->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ]
        )->contain(['Districts']);
        $session = $this->request->session();

        $this->set(compact('scoutgroups', 'resForm'));

        if ($this->request->is('post')) {
            if ($session->check('Reset.rsTries')) {
                $tries = $session->read('Reset.rsTries');
            }

            if (!isset($tries)) {
                $tries = 0;
            }

            if (isset($tries) && $tries < 6) {
                // Extract Form Info
                $fmGroup = $this->request->data['scoutgroup'];
                $fmEmail = $this->request->data['email'];

                $found = $this->Users->find('all')
                    ->contain('Sections')
                    ->where(['email' => $fmEmail, 'Sections.scoutgroup_id' => $fmGroup]);

                $count = $found->count('*');
                $user = $found->first();

                $tries = $tries + 1;
                $session->write('Reset.rsTries', $tries);

                if ($count == 1) {
                    // Success in Resetting Triggering Reset - Bouncing to Reset.
                    $session->delete('Reset.lgTries');
                    $session->delete('Reset.rsTries');

                    $this->loadComponent('Password');

                    if ($this->Password->sendReset($user->id)) {
                        $this->Flash->success('We have sent a password reset token to your email. This is valid for a short period of time.');

                        return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
                    }

                    $this->Flash->error(__('The user could not be saved. Please, try again.'));

                    $this->log('Token Creation Error during Password Reset for user ' . $user->id, 'notice');
                } else {
                    $this->Flash->error('This user was not found in the system.');
                }
            } else {
                $this->Flash->error('You have failed entry too many times. Please try again later.');

                return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
            }
        }
    }

    /**
     * Token - Completes Password Reset Function
     *
     * @param string $token The String to Be Validated
     *
     * @return \Cake\Http\Response|null
     */
    public function token($token = null)
    {
        $tokenTable = TableRegistry::get('Tokens');

        $this->viewBuilder()->setLayout('outside');

        $valid = $tokenTable->validateToken($token);
        if (!$valid) {
            $this->Flash->error('Password Reset Token could not be validated.');

            return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
        }

        if (is_numeric($valid)) {
            $tokenRow = $tokenTable->get($valid);
            $resetUser = $this->Users->get($tokenRow->user_id);

            $passwordForm = new PasswordForm();
            $this->set(compact('passwordForm'));

            if ($this->request->is('post')) {
                $fmPassword = $this->request->getData('newpw');
                $fmConfirm = $this->request->getData('confirm');

                if ($fmConfirm == $fmPassword) {
                    $fmPostcode = $this->request->getData('postcode');
                    $fmPostcode = str_replace(" ", "", strtoupper($fmPostcode));

                    $usPostcode = $resetUser->postcode;
                    $usPostcode = str_replace(" ", "", strtoupper($usPostcode));

                    if ($usPostcode == $fmPostcode) {
                        $newPw = ['password' => $fmPassword
                            , 'reset' => 'No Longer Active'];

                        $resetUser = $this->Users->patchEntity($resetUser, $newPw, [ 'fields' => ['password'], 'validate' => false ]);

                        if ($this->Users->save($resetUser)) {
                            $this->Flash->success('Your password was saved successfully.');

                            return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
                        } else {
                            $this->Flash->error(__('The user could not be saved. Please try again.'));
                        }
                    } else {
                        $this->Flash->error(__('Your postcode could not be validated. Please try again.'));
                    }
                } else {
                    $this->Flash->error(__('The passwords you have entered do not match. Please try again.'));
                }
            }
        }
    }

    /**
     * @param $userId
     *
     * @return \Cake\Network\Response|null
     */
    public function validate($userId)
    {
        $this->viewBuilder()->layout('outside');

        $user = $this->Users->get($userId);

        $validation = ['validated' => 1];

        $user = $this->Users->patchEntity($user, $validation);

        if ($this->Users->save($user)) {
            //$this->Flash->success();
            return $this->redirect(['prefix' => false, 'controller' => 'Notifications', 'action' => 'validate']);
        } else {
            return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'welcome']);
        }
    }

    public function logout()
    {
        $session = $this->request->session();
        $session->delete('OSM.Secret');

        $this->Flash->success('You are now logged out.');

        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['register']);
        $this->Auth->allow(['login']);
        $this->Auth->allow(['validate']);
        $this->Auth->allow(['reset']);
        $this->Auth->allow(['token']);
    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['logout'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['view', 'edit'])) {
            $editingId = (int)$this->request->params['pass'][0];
            if ($editingId == $user['id']) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
