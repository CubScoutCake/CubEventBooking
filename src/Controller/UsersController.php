<?php
namespace App\Controller;

use App\Controller\AppController;
//use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
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
            'contain' => ['Roles', 'Scoutgroups']
        ];
        $this->paginate['conditions'] = array(
            'scoutgroup_id' => $this->Auth->user('scoutgroup_id')
        );
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
            'contain' => ['Roles', 'Scoutgroups'
            ,'Applications' => ['conditions' => ['user_id' => $this->Auth->user('id')]]
            ,'Attendees' => [/*'contain' => 'Scoutgroups',*/ 'conditions' => ['user_id' => $this->Auth->user('id')]]]
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    //use MailerAwareTrait;

    public function register()
    {
        $user = $this->Users->newEntity($this->request->data);

        $usrData = ['section' => 'Cubs', 'authrole' => 'user'];
        $user = $this->Users->patchEntity($user, $usrData);

        if ($this->Users->save($user)) {
            $this->Flash->success(__('You have sucesfully registered!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        } else {
            $this->Flash->error(__('The user could not be registered. There may be an error. Please, try again.'));
        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $scoutgroups = $this->Users->Scoutgroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'scoutgroups'));
        $this->set('_serialize', ['user']);
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

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function login($eventId = null)
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if (isset($eventId) && $eventId >= 0) {
                    return $this->redirect(['prefix' => false, 'controller' => 'Applications', 'action' => 'book',  $eventId]);
                } else {
                    return $this->redirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'user_home']);
                }  
            }
            $this->Flash->error('Your username or password is incorrect. Please try again.');
        }

        $this->set(compact('eventId'));
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
