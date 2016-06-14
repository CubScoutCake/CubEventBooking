<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\MailerAwareTrait;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
//use DataTables\Controller\Component;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    use MailerAwareTrait;

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles', 'Scoutgroups']
            ,'order' => ['modified' => 'DESC']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($id == $this->Auth->user('id')) {
            return $this->redirect(['controller' => 'Users', 'action' => 'view', 'prefix' => false, $id]);
        }
        
        $user = $this->Users->get($id, [
            'contain' => ['Roles'
                , 'Scoutgroups'
                , 'Applications' => ['Scoutgroups', 'Events']
                , 'Attendees' => ['Scoutgroups', 'Roles', 'sort' => ['role_id' => 'ASC', 'lastname' => 'ASC']]
                , 'Invoices.Applications.Events'
                , 'Notes' => ['Invoices' , 'Applications']
                , 'Notifications' => ['Notificationtypes', 'sort' => ['read_date' => 'DESC', 'created' => 'DESC']]
            ]
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            $upperUser = ['firstname' => ucwords(strtolower($user->firstname))
                ,'lastname' => ucwords(strtolower($user->lastname))
                ,'address_1' => ucwords(strtolower($user->address_1))
                ,'address_2' => ucwords(strtolower($user->address_2))
                ,'city' => ucwords(strtolower($user->city))
                ,'county' => ucwords(strtolower($user->county))
                ,'postcode' => strtoupper($user->postcode)
                ,'section' => ucwords(strtolower($user->section))];

            $user = $this->Users->patchEntity($user, $upperUser);
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $scoutgroups = $this->Users->Scoutgroups->find('list', 
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ])
            ->contain(['Districts']);
        $this->set(compact('user', 'roles', 'scoutgroups'));
        $this->set('_serialize', ['user']);
    }

    // use MailerAwareTrait;

    /*public function register()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {

            $user = $this->Users->patchEntity($user, $this->request->data);

            $newData = ['section' => 'Cubs', 'authrole' => 'user'];
            $user = $this->Users->patchEntity($user, $newData);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('You have sucesfully registered!'));
                return $this->redirect(['controller' => 'Users', 'action' => 'login','prefix' => false]);
            } else {
                $this->Flash->error(__('The user could not be registered. There may be an error. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $scoutgroups = $this->Users->Scoutgroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'scoutgroups'));
        $this->set('_serialize', ['user']);

    }*/

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

            $upperUser = ['firstname' => ucwords(strtolower($user->firstname))
                ,'lastname' => ucwords(strtolower($user->lastname))
                ,'address_1' => ucwords(strtolower($user->address_1))
                ,'address_2' => ucwords(strtolower($user->address_2))
                ,'city' => ucwords(strtolower($user->city))
                ,'county' => ucwords(strtolower($user->county))
                ,'postcode' => strtoupper($user->postcode)
                ,'section' => ucwords(strtolower($user->section))];

            $user = $this->Users->patchEntity($user, $upperUser);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $scoutgroups = $this->Users->Scoutgroups->find('list', 
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ])
            ->contain(['Districts']);
        $this->set(compact('user', 'roles', 'scoutgroups'));
        $this->set('_serialize', ['user']);
    }

    public function update($id = null)
    {
        $user = $this->Users->get($id);

        $upperUser = ['firstname' => ucwords(strtolower($user->firstname))
            ,'lastname' => ucwords(strtolower($user->lastname))
            ,'address_1' => ucwords(strtolower($user->address_1))
            ,'address_2' => ucwords(strtolower($user->address_2))
            ,'city' => ucwords(strtolower($user->city))
            ,'county' => ucwords(strtolower($user->county))
            ,'postcode' => strtoupper($user->postcode)
            ,'section' => ucwords(strtolower($user->section))];

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

        $random = rand($rMin,$rMax);

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
