<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Mailer\MailerAwareTrait;
use Cake\Network\Http\Client;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
{
    use MailerAwareTrait;

    // /**
    //  * Index method
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Notificationtypes'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    public function unread()
    {
        $this->paginate = [
            'contain' => ['Users', 'Notificationtypes'],
            'conditions' => ['user_id' => $this->Auth->user('id'), 'new' => 1]
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    // /**
    //  * View method
    //  *
    //  * @param string|null $id Notification id.
    //  * @return void
    //  * @throws \Cake\Network\Exception\NotFoundException When record not found.
    //  */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Users', 'Notificationtypes']
        ]);
        $this->set('notification', $notification);
        $this->set('_serialize', ['notification']);

        $now = Time::now();
        $nowData = ['new' => 0, 'read_date' => $now];

        if ($notification->new == 1) {
            $notification = $this->Notifications->patchEntity($notification, $nowData);

            if ($this->Notifications->save($notification)) {

                $viewEnt = [
                    'Entity Id' => $notification->id,
                    'Controller' => 'Notifications',
                    'Action' => 'View',
                    'User Id' => $this->Auth->user('id'),
                    'Creation Date' => $notification->created,
                    'Modified' => $notification->read_date,
                    'Notification' => [
                        'Type' => $notification->notificationtype_id,
                        'Ref Id' => $notification->link_id,
                        'Action' => $notification->link_action,
                        'Controller' => $notification->link_controller,
                        'Source' => $notification->notification_source,
                        'Header' => $notification->notification_header
                        ]
                    ];

                $sets = TableRegistry::get('Settings');
                
                $jsonView = json_encode($viewEnt);
                $api_key = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';
                
                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $api_key;
                
                $http = new Client();
                $response = $http->post(
                  $keenURL,
                  $jsonView,
                  ['type' => 'json']
                );

                $this->Flash->success(__('The notification has been marked as viewed.'));
            } else {
                $this->Flash->error(__('The notification could not be marked as viewed. Please, try again.'));
            }
        }
    }

    // public function clean($userId = null)
    // {
    //     $this->request->allowMethod('delete');
        
    //     $notifications = $this->Notifications->find('all')->where(['user_id' => $userId]);

    //     $count = 0;

    //     foreach ($notifications as $notification) {
    //         if ($this->Notifications->delete($notification)) {
    //             $count = $count + 1;
    //         } else {
    //             $this->Flash->error(__('There was an error.'));
    //         }
    //     }

    //     $this->Flash->success(__($count . ' notifications were cleaned.'));
    //     return $this->redirect(['action' => 'index']);
        
    // }

    // /**
    //  * Add method
    //  *
    //  * @return void Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {
    //     $notification = $this->Notifications->newEntity();
    //     if ($this->request->is('post')) {
    //         $notification = $this->Notifications->patchEntity($notification, $this->request->data);
    //         if ($this->Notifications->save($notification)) {
    //             $this->Flash->success(__('The notification has been saved.'));
    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             $this->Flash->error(__('The notification could not be saved. Please, try again.'));
    //         }
    //     }
    //     $users = $this->Notifications->Users->find('list', ['limit' => 200]);
    //     $notificationtypes = $this->Notifications->Notificationtypes->find('list', ['limit' => 200]);
    //     $this->set(compact('notification', 'users', 'notificationtypes'));
    //     $this->set('_serialize', ['notification']);
    // }

    public function welcome($userId = null)
    {
        if(isset($userId)) {

            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $user = $users->get($userId, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $welcomeData = [     'link_id' => $userId
                                , 'link_controller' => 'Users'
                                , 'link_action' => 'view'
                                , 'notificationtype_id' => 1
                                , 'user_id' => $userId
                                , 'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.'
                                , 'notification_header' => 'Welcome to the Herts Cubs Booking System'
                                , 'notification_source' => 'System Generated'
                                , 'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

                $sets = TableRegistry::get('Settings');

                $jsonWelcome = json_encode($welcomeData);
                $api_key = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'UserWelcome';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $api_key;

                $http = new Client();
                $response = $http->post(
                  $keenURL,
                  $jsonWelcome,
                  ['type' => 'json']
                );

                $genericType = 'Notification';

                $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $api_key;

                $http = new Client();
                $response = $http->post(
                  $keenGenURL,
                  $jsonWelcome,
                  ['type' => 'json']
                );

                return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false, $userId]);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } //else {
        //     $this->Flash->error(__('Parameters were not set!'));
        //     return $this->redirect(['action' => 'index']);
        // }
    }

    public function new_logistic()
    {
        
    }

    public function new_reset()
    {
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $notificationtypes = $this->Notifications->Notificationtypes->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users', 'notificationtypes'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $notification = $this->Notifications->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $notification = $this->Notifications->patchEntity($notification, $this->request->data);
    //         if ($this->Notifications->save($notification)) {
    //             $this->Flash->success(__('The notification has been saved.'));
    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             $this->Flash->error(__('The notification could not be saved. Please, try again.'));
    //         }
    //     }
    //     $users = $this->Notifications->Users->find('list', ['limit' => 200]);
    //     $notificationtypes = $this->Notifications->Notificationtypes->find('list', ['limit' => 200]);
    //     $this->set(compact('notification', 'users', 'notificationtypes'));
    //     $this->set('_serialize', ['notification']);
    // }

    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id Notification id.
    //  * @return void Redirects to index.
    //  * @throws \Cake\Network\Exception\NotFoundException When record not found.
    //  */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($id);
        if ($notification->user_id == $this->Auth->user('id')) {
            if ($this->Notifications->delete($notification)) {

                $deleteEnt = [
                    'Entity Id' => $notification->id,
                    'Controller' => 'Notifications',
                    'Action' => 'Delete',
                    'User Id' => $this->Auth->user('id'),
                    'Creation Date' => $notification->created,
                    'Modified' => $notification->read_date,
                    'Notification' => [
                        'Type' => $notification->notificationtype_id,
                        'Ref Id' => $notification->link_id,
                        'Action' => $notification->link_action,
                        'Controller' => $notification->link_controller,
                        'Source' => $notification->notification_source,
                        'Header' => $notification->notification_header
                        ]
                    ];

                $sets = TableRegistry::get('Settings');
                
                $jsonDelete = json_encode($deleteEnt);
                $api_key = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';
                
                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $api_key;
                
                $http = new Client();
                $response = $http->post(
                  $keenURL,
                  $jsonDelete,
                  ['type' => 'json']
                );

                $this->Flash->success(__('The notification has been deleted.'));
            } else {
                $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('You do not have permission to delete this notification.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['welcome','delete']);
    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['unread', 'index'])) {
            return true;
        }

        if (in_array($this->request->action, ['edit'])) {
            return false;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['delete', 'view'])) {
            $notificationId = (int)$this->request->params['pass'][0];
            if ($this->Notifications->isOwnedBy($notificationId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
