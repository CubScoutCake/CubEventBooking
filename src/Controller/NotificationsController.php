<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\Time;
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
            'conditions' => ['user_id' => $this->Auth->user('id')],
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
            'conditions' => ['user_id' => $this->Auth->user('id'), 'new' => true],
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Users', 'NotificationTypes'],
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
                        'Header' => $notification->notification_header,
                    ],
                ];

                $sets = TableRegistry::get('Settings');

                $jsonView = json_encode($viewEnt);
                $apiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'Action';

                $keenURL = 'https://api.keen.io/3.0/projects/' .
                           $projectId . '/events/' .
                           $eventType . '?api_key=' . $apiKey;

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
     * Returns a boolean for whether a logged in user is authorised to view a specific record.
     *
     * @param \App\Model\Entity\User $user The Logged In User
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->getRequest()->getParam('action'), ['unread', 'index'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->getRequest()->getParam('action'), ['delete', 'view'])) {
            $notificationId = (int)$this->request->getParam('pass')[0];
            if ($this->Notifications->isOwnedBy($notificationId, $user['id'])) {
                return true;
            }

            return false;
        }

        return parent::isAuthorized($user->toArray());
    }
}
