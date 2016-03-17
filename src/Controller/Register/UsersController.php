<?php
namespace App\Controller\Register;

use App\Controller\Register\AppController;
//use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function register($eventId = null)
    {
        $user = $this->Users->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $usrData = ['section' => 'Cubs', 'authrole' => 'user'];
            $user = $this->Users->patchEntity($user, $usrData);

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

                $redir = $user->get('id');

                $this->Flash->success(__('You have successfully registered!'));
                return $this->redirect(['controller' => 'Notifications', 'action' => 'welcome', 'prefix' => false, $redir, $eventId]);
            } else {
                $this->Flash->error(__('The user could not be registered. There may be an error. Please, try again.'));
            }

        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200, 'conditions' => ['minor' => 0, 'invested' => 1]]);
<<<<<<< HEAD
        $scoutgroups = $this->Users->Scoutgroups->find('list', 
            [
                'keyField' => 'id',
                'valueField' => 'scoutgroup',
                'groupField' => 'district.district'
            ])
            ->contain(['Districts']);
=======
        $scoutgroups = $this->Users->Scoutgroups->find('list', ['limit' => 200]);
>>>>>>> master
        $this->set(compact('user', 'roles', 'scoutgroups'));
        $this->set('_serialize', ['user']);
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['register']);
    }
    
}
