<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\MailerAwareTrait;
<<<<<<< HEAD
//use DataTables\Controller\Component;
=======
>>>>>>> master

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
        $user = $this->Users->get($id, [
            'contain' => ['Roles'
                , 'Scoutgroups'
                , 'Applications.Scoutgroups', 'Applications.Events'
                , 'Attendees.Scoutgroups', 'Attendees.Roles'
                , 'Invoices.Applications.Events']
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
<<<<<<< HEAD

            $upperUser = ['firstname' => ucwords(strtolower($user->firstname))
                ,'lastname' => ucwords(strtolower($user->lastname))
                ,'address_1' => ucwords(strtolower($user->address_1))
                ,'address_2' => ucwords(strtolower($user->address_2))
                ,'city' => ucwords(strtolower($user->city))
                ,'county' => ucwords(strtolower($user->county))
                ,'postcode' => strtoupper($user->postcode)
                ,'section' => ucwords(strtolower($user->section))];

            $user = $this->Users->patchEntity($user, $upperUser);
            
=======
>>>>>>> master
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $scoutgroups = $this->Users->Scoutgroups->find('list', ['limit' => 200]);
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
<<<<<<< HEAD

            $upperUser = ['firstname' => ucwords(strtolower($user->firstname))
                ,'lastname' => ucwords(strtolower($user->lastname))
                ,'address_1' => ucwords(strtolower($user->address_1))
                ,'address_2' => ucwords(strtolower($user->address_2))
                ,'city' => ucwords(strtolower($user->city))
                ,'county' => ucwords(strtolower($user->county))
                ,'postcode' => strtoupper($user->postcode)
                ,'section' => ucwords(strtolower($user->section))];

            $user = $this->Users->patchEntity($user, $upperUser);

=======
>>>>>>> master
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $scoutgroups = $this->Users->Scoutgroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'scoutgroups'));
        $this->set('_serialize', ['user']);
    }

<<<<<<< HEAD
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

=======
>>>>>>> master
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
