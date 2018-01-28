<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Mailer\MailerAwareTrait;
use Cake\Network\Http\Client;
use Cake\ORM\TableRegistry;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
{
    use MailerAwareTrait;

    /**
     * Index Function
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'NotificationTypes'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    /**
     * Returns the Index with only Unread Notifications
     *
     * @return void
     */
    public function unread()
    {
        $this->paginate = [
            'contain' => ['Users', 'NotificationTypes'],
            'conditions' => ['user_id' => $this->Auth->user('id'), 'new' => 1]
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Users', 'NotificationTypes']
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
                        'Type' => $notification->notification_type_id,
                        'Ref Id' => $notification->link_id,
                        'Action' => $notification->link_action,
                        'Controller' => $notification->link_controller,
                        'Source' => $notification->notification_source,
                        'Header' => $notification->notification_header
                        ]
                    ];

                $sets = TableRegistry::get('Settings');

                $jsonView = json_encode($viewEnt);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

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

        $usersNotifID = $this->Auth->user('id');
        $notificationEnts = $this->Notifications->find('unread')->where(['user_id' => $usersNotifID]);
        $notificationCount = $notificationEnts->count();

        if (isset($notificationCount) && $notificationCount > 0) {
            $unreadNotifications = true;
        } else {
            $unreadNotifications = false;
        }
        $this->set(compact('unreadNotifications'));
    }

    /**
     * @param int $userId The User ID
     *
     * @return \Cake\Http\Response|null
     */
    public function welcome($userId = null)
    {
        if (isset($userId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $user = $users->get($userId, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $welcomeData = [
                'link_id' => $userId,
                'link_controller' => 'Users',
                'link_action' => 'view',
                'notification_type_id' => 1,
                'user_id' => $userId,
                'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.',
                'notification_header' => 'Welcome to the Herts Cubs Booking System',
                'notification_source' => 'System Generated',
                'new' => 1,
            ];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

                $sets = TableRegistry::get('Settings');

                $jsonWelcome = json_encode($welcomeData);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'UserWelcome';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonWelcome,
                    ['type' => 'json']
                );

                $genericType = 'Notification';

                $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $apiKey;

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

    /**
     * @param null $userId The User ID
     *
     * @return \Cake\Http\Response|null
     */
    public function validate($userId = null)
    {
        if (isset($userId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $user = $users->get($userId, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $welcomeData = [
                'link_id' => $userId,
                'link_controller' => 'Users',
                'link_action' => 'view',
                'notification_type_id' => 1,
                'user_id' => $userId,
                'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.',
                'notification_header' => 'Welcome to the Herts Cubs Booking System',
                'notification_source' => 'System Generated',
                'new' => 1
            ];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

                $sets = TableRegistry::get('Settings');

                $jsonWelcome = json_encode($welcomeData);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'UserWelcome';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonWelcome,
                    ['type' => 'json']
                );

                $genericType = 'Notification';

                $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $apiKey;

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

    /**
     * @return \Cake\Http\Response|null
     */
    public function newReset()
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
        $NotificationTypes = $this->Notifications->NotificationTypes->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users', 'NotificationTypes'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * @param int $id The Notification ID to Delete
     *
     * @return \Cake\Http\Response|null
     */
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
                        'Type' => $notification->notification_type_id,
                        'Ref Id' => $notification->link_id,
                        'Action' => $notification->link_action,
                        'Controller' => $notification->link_controller,
                        'Source' => $notification->notification_source,
                        'Header' => $notification->notification_header
                        ]
                    ];

                $sets = TableRegistry::get('Settings');

                $jsonDelete = json_encode($deleteEnt);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $apiKey;

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

    /**
     * Returning
     *
     * @param \Cake\Event\Event $event The Event that Triggered the Function
     *
     * @return \Cake\Http\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['welcome', 'delete']);
    }

    /**
     * Returns a boolean for whether a logged in user is authorised to view a specific record.
     *
     * @param \App\Model\Entity\User $user The Logged In User
     *
     * @return bool
     */
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
