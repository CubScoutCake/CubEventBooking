<?php
namespace App\Controller\Register;

use App\Controller\Register\AppController;
use Cake\ORM\TableRegistry;
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

            $usrData = ['authrole' => 'user'];

            $user = $this->Users->patchEntity($user, $this->request->data);

            $user = $this->Users->patchEntity($user, $usrData);

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

                $atts = TableRegistry::get('Attendees');

                $att = $atts->newEntity();

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
                    'scoutgroup_id' => $user->scoutgroup_id,
                    'phone' => $user->phone,
                    'dateofbirth' => '01-01-1980'
                ];

                $att = $atts->patchEntity($att, $attendeeData);

                if ($atts->save($att)) {
                    $this->Flash->success(__('An Attendee for your user has been created.'));
                }

                $redir = $user->get('id');

                $this->Flash->success(__('You have successfully registered!'));
                return $this->redirect(['controller' => 'Notifications', 'action' => 'welcome', 'prefix' => false, $redir, $eventId]);
            } else {
                $this->Flash->error(__('The user could not be registered. There may be an error. Please, try again.'));
            }

        }

        $roles = $this->Users->Roles->find('nonAuto')->find('leaders')->find('list', ['limit' => 200]);
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

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['register']);
    }
    
}
