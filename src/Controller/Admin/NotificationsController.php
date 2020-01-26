<?php
declare(strict_types=1);

namespace App\Controller\Admin;

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
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'NotificationTypes'],
            'order' => ['created' => 'DESC'],
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    /**
     * Display the index with Unread Notifications
     *
     * @return void
     */
    public function unread()
    {
        $this->paginate = [
            'contain' => ['Users', 'NotificationTypes'],
            'conditions' => ['new' => 1],
            'order' => ['created' => 'DESC'],
        ];
        $this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['notifications']);
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
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
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $notification_types = $this->Notifications->NotificationTypes->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users', 'notification_types'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Welcome Email Send - On Registration
     *
     * @param int $userId The ID of the User Registered
     * @return \Cake\Http\Response|void
     */
    public function welcome($userId = null)
    {
        if (isset($userId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $user = $users->get($userId, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $welcomeData = [ 'link_id' => $userId,
                            'link_controller' => 'Users',
                            'link_action' => 'view',
                            'link_prefix' => false,
                            'notification_type_id' => 1,
                            'user_id' => $userId,
                            'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.',
                            'notification_header' => 'Welcome to the Herts Cubs Booking System',
                            'notification_source' => 'Admin Triggered',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

                $sets = TableRegistry::get('Settings');

                $jsonWelcome = json_encode($welcomeData);
                $wApiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'UserWelcome';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $wApiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonWelcome,
                    ['type' => 'json']
                );

                $genericType = 'Notification';

                $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $wApiKey;

                $http = new Client();
                $response = $http->post(
                    $keenGenURL,
                    $jsonWelcome,
                    ['type' => 'json']
                );

                return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'view', $userId]);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Parameters were not set!'));

            return $this->redirect(['prefix' => 'admin', 'controller' => 'Landing', 'action' => 'admin_home']);
        }
    }

    /**
     * Notification of a New Payment Record
     *
     * @param int $payId The Payment ID to be Notified
     * @return \Cake\Http\Response|void
     */
    public function newPayment($payId = null)
    {
        if (isset($payId)) {
            $users = TableRegistry::get('Users');
            $invoices = TableRegistry::get('Invoices');
            $payments = TableRegistry::get('Payments');

            $payment = $payments->get($payId);

            $invoiceSel = $invoices->find('all')
            ->enableHydration(true)
            ->join([
                'x' => ['table' => 'invoices_payments', 'type' => 'INNER', 'conditions' => 'x.invoice_id = Invoices.id', ],
                't' => ['table' => 'payments', 'type' => 'INNER', 'conditions' => 't.id = x.payment_id', ],
            ])
            ->where(['t.id' => $payId])
            ->first();

            $invoiceId = $invoiceSel->id;

            $invoice = $invoices->get($invoiceId);

            $user = $users->get($invoice->user_id, ['contain' => ['Sections.Scoutgroups']]);
            $group = $user->section->scoutgroup;

            $paymentData = [ 'link_id' => $invoice->id,
                            'link_controller' => 'Invoices',
                            'link_action' => 'view',
                            'notification_type_id' => 2,
                            'user_id' => $invoice->user_id,
                            'text' => 'We have received a payment and have recorded it against your invoice. Please check that everything is in order.',
                            'notification_header' => 'A payment has been recorded.',
                            'notification_source' => 'System Generated',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $paymentData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Payment Notification Sent.'));

                $this->getMailer('Payment')->send('payment', [$user, $group, $notification, $invoice, $payment]);

                $sets = TableRegistry::get('Settings');

                $jsonPayment = json_encode($paymentData);
                $pApiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'NewPayment';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $pApiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonPayment,
                    ['type' => 'json']
                );

                $genericType = 'Notification';

                $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $pApiKey;

                $http = new Client();
                $response = $http->post(
                    $keenGenURL,
                    $jsonPayment,
                    ['type' => 'json']
                );

                return $this->redirect(['controller' => 'Payments', 'action' => 'add', 'prefix' => 'admin']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } //else {
        //     $this->Flash->error(__('Parameters were not set!'));
        //     return $this->redirect(['action' => 'index']);
        // }
    }

    /**
     * @param int $payId Payment ID to be notified
     * @return \Cake\Http\Response|void
     */
    public function notifyPayment($payId = null)
    {
        if (isset($payId)) {
            $users = TableRegistry::get('Users');
            $invoices = TableRegistry::get('Invoices');
            $payments = TableRegistry::get('Payments');

            $payment = $payments->get($payId);

            $invoiceSel = $invoices->find('all')
            ->enableHydration(true)
            ->join([
                'x' => ['table' => 'invoices_payments', 'type' => 'INNER', 'conditions' => 'x.invoice_id = Invoices.id', ],
                't' => ['table' => 'payments', 'type' => 'INNER', 'conditions' => 't.id = x.payment_id', ],
            ])
            ->where(['t.id' => $payId])
            ->first();

            $invoiceId = $invoiceSel->id;

            $invoice = $invoices->get($invoiceId);

            $user = $users->get($invoice->user_id, ['contain' => ['Sections.Scoutgroups']]);
            $group = $user->section->scoutgroup;

            $paymentData = [ 'link_id' => $invoice->id,
                            'link_controller' => 'Invoices',
                            'link_action' => 'view',
                            'notification_type_id' => 2,
                            'user_id' => $invoice->user_id,
                            'text' => 'We have received a payment and have recorded it against your invoice. Please check that everything is in order.',
                            'notification_header' => 'A payment has been recorded.',
                            'notification_source' => 'Admin Triggered',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $paymentData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Payment Notification Sent.'));

                $this->getMailer('Payment')->send('payment', [$user, $group, $notification, $invoice, $payment]);

                $sets = TableRegistry::get('Settings');

                $jsonPayment = json_encode($paymentData);
                $pApiKey = $sets->get(13)->text;
                $projectId = $sets->get(14)->text;
                $eventType = 'NewPayment';

                $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $pApiKey;

                $http = new Client();
                $response = $http->post(
                    $keenURL,
                    $jsonPayment,
                    ['type' => 'json']
                );

                $genericType = 'Notification';

                $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $pApiKey;

                $http = new Client();
                $response = $http->post(
                    $keenGenURL,
                    $jsonPayment,
                    ['type' => 'json']
                );

                return $this->redirect(['controller' => 'Payments', 'action' => 'index', 'prefix' => 'admin']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } //else {
        //     $this->Flash->error(__('Parameters were not set!'));
        //     return $this->redirect(['action' => 'index']);
        // }
    }

    /**
     * @param int $invoiceId ID of the Invoice
     * @return \Cake\Http\Response|void
     */
    public function outstanding($invoiceId = null)
    {
        if (isset($invoiceId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');
            $invoices = TableRegistry::get('Invoices');
            $applications = TableRegistry::get('Applications');
            $notes = TableRegistry::get('Notes');

            $invoice = $invoices->get($invoiceId);
            $user = $users->get($invoice->user_id, ['contain' => 'Sections']);
            $group = $groups->get($user->section->scoutgroup_id);
            $app = $applications->get($invoice->application_id);

            $invoiceData = [ 'link_id' => $invoice->id,
                            'link_controller' => 'Invoices',
                            'link_action' => 'view',
                            'notification_type_id' => 8,
                            'user_id' => $invoice->user_id,
                            'text' => 'There is a balance outstanding on this Invoice.',
                            'notification_header' => 'Balance Outstanding',
                            'notification_source' => 'Admin Triggered',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $invoiceData);

            if ($this->Notifications->save($notification)) {
                $notificationId = $notification->get('id');

                $noteData = [
                    'note_text' => 'A Balance Outstanding Prompt Email was Sent with Notification id #' . $notificationId,
                    'visible' => false,
                    'user_id' => $user->id,
                    'invoice_id' => $invoice->id,
                    'application_id' => $app->id,
                ];

                $note = $notes->newEntity();
                $note = $notes->patchEntity($note, $noteData);

                if ($notes->save($note)) {
                    $this->Flash->success(__('Outstanding Balance Prompt Sent.'));

                    $this->getMailer('Payment')->send('outstanding', [$user, $group, $notification, $invoice, $app]);

                    $sets = TableRegistry::get('Settings');

                    $jsonInvoice = json_encode($invoiceData);
                    $pApiKey = $sets->get(13)->text;
                    $projectId = $sets->get(14)->text;
                    $eventType = 'OutstandingPayment';

                    $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $pApiKey;

                    $http = new Client();
                    $response = $http->post(
                        $keenURL,
                        $jsonInvoice,
                        ['type' => 'json']
                    );

                    $genericType = 'Notification';

                    $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $pApiKey;

                    $http = new Client();
                    $response = $http->post(
                        $keenGenURL,
                        $jsonInvoice,
                        ['type' => 'json']
                    );

                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', 'prefix' => 'admin', $invoiceId]);
                } else {
                    $this->Flash->error(__('The note could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Parameters were not set!'));

            return $this->redirect(['controller' => 'Landing', 'action' => 'admin_home', 'prefix' => 'admin']);
        }
    }

    /**
     * @param int $invoiceId The Id of the Invoice
     * @param float $percentage The Surcharge Percentage Applied
     * @return \Cake\Http\Response|void
     */
    public function surcharge($invoiceId = null, $percentage = null)
    {
        if (isset($invoiceId) && isset($percentage)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');
            $invoices = TableRegistry::get('Invoices');
            $applications = TableRegistry::get('Applications');
            $notes = TableRegistry::get('Notes');

            $invoice = $invoices->get($invoiceId);
            $user = $users->get($invoice->user_id);
            $group = $groups->get($user->scoutgroup_id);
            $app = $applications->get($invoice->application_id);

            $feePercentage = $percentage / 100;

            $invoiceData = [ 'link_id' => $invoice->id,
                            'link_controller' => 'Invoices',
                            'link_action' => 'view',
                            'notification_type_id' => 9,
                            'user_id' => $invoice->user_id,
                            'text' => 'A Balance Surcharge of ' . $percentage . '% of Balance was added.',
                            'notification_header' => 'Late Payment Surcharge Added',
                            'notification_source' => 'Admin Triggered',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $invoiceData);

            if ($this->Notifications->save($notification)) {
                $notificationId = $notification->get('id');

                $noteData = [ 'note_text' => 'A Balance Surcharge of ' . $percentage . '% was added to the Invoice. With notification #' . $notificationId,
                    'visible' => true,
                    'user_id' => $user->id,
                    'invoice_id' => $invoice->id,
                    'application_id' => $app->id,
                ];

                $note = $notes->newEntity();
                $note = $notes->patchEntity($note, $noteData);

                $feeVal = $invoice->initial_value - $invoice->value;
                $fee = $feeVal * $feePercentage;

                if ($notes->save($note)) {
                    $this->Flash->success(__('Outstanding Balance Prompt Sent.'));

                    $this->getMailer('Payment')->send('surcharge', [$user, $group, $notification, $invoice, $app, $percentage, $fee]);

                    $sets = TableRegistry::get('Settings');

                    $jsonInvoice = json_encode($invoiceData);
                    $pApiKey = $sets->get(13)->text;
                    $projectId = $sets->get(14)->text;
                    $eventType = 'PaymentSurcharge';

                    $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $pApiKey;

                    $http = new Client();
                    $response = $http->post(
                        $keenURL,
                        $jsonInvoice,
                        ['type' => 'json']
                    );

                    $genericType = 'Notification';

                    $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $pApiKey;

                    $http = new Client();
                    $response = $http->post(
                        $keenGenURL,
                        $jsonInvoice,
                        ['type' => 'json']
                    );

                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', 'prefix' => 'admin', $invoiceId]);
                } else {
                    $this->Flash->error(__('The note could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Parameters were not set!'));

            return $this->redirect(['controller' => 'Landing', 'action' => 'admin_home', 'prefix' => 'admin']);
        }
    }

    /**
     * @param int $invoiceId The ID of the Invoice
     * @return \Cake\Http\Response|void
     */
    public function depositQuery($invoiceId = null)
    {
        if (isset($invoiceId)) {
            $invs = TableRegistry::get('Invoices');
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $invoice = $invs->get($invoiceId, ['contain' => ['Users']]);

            $user = $users->get($invoice->user_id, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $invQueryData = ['link_id' => $user->id,
                            'link_controller' => 'Users',
                            'link_action' => 'view',
                            'notification_type_id' => 1,
                            'user_id' => $user->id,
                            'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.',
                            'notification_header' => 'Welcome to the Herts Cubs Booking System',
                            'notification_source' => 'System Generated',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

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
     * Notification where there is no Invoice
     *
     * @param int $appId Application ID
     * @return \Cake\Http\Response|void
     */
    public function noInv($appId = null)
    {
        if (isset($appId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $user = $users->get($userId, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $welcomeData = ['link_id' => $userId,
                            'link_controller' => 'Users',
                            'link_action' => 'view',
                            'link_prefix' => false,
                            'notification_type_id' => 1,
                            'user_id' => $userId,
                            'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.',
                            'notification_header' => 'Welcome to the Herts Cubs Booking System',
                            'notification_source' => 'System Generated',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

                /*$email = new Email('default');
                $email->template('welcome', 'default')
                    ->emailFormat('html')
                    ->to([$user->email => $user->full_name])
                    ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
                    ->subject('Welcome to the Hertfordshire Cubs Booking System')
                    ->setHeaders(['X-MC-Tags' => 'WelcomeEmail,Type1,Notification'
                        , 'X-MC-AutoText' => true
                        , 'X-MC-GoogleAnalytics' => 'hertscubs100.uk,hertscubs.uk,hcbooking.uk,booking.hertscubs100.uk,champions.hertscubs100.uk,booking.hertscubs.uk'
                        , 'X-MC-GoogleAnalyticsCampaign' => 'Welcome_Email'
                        , 'X-MC-TrackingDomain' => 'track.hertscubs.uk' ])
                    ->viewVars(['username' => $user->username
                        , 'date_created' => $user->created
                        , 'full_name' => $user->full_name
                        , 'scoutgroup' => $group->scoutgroup
                        , 'link_controller' => $notification->link_controller
                        , 'link_action' => $notification->link_action
                        , 'link_id' => $notification->link_id
                        , 'link_prefix' => $notification->link_prefix
                        , 'notification_id' => $notification->id
                        ])
                    ->helpers(['Html', 'Text', 'Time'])
                    ->send();*/

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Parameters were not set!'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * @param int $appId The Id of the Application
     * @return \Cake\Http\Response|void
     */
    public function multipleInv($appId = null)
    {
        if (isset($appId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');

            $user = $users->get($userId, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $welcomeData = ['link_id' => $userId,
                            'link_controller' => 'Users',
                            'link_action' => 'view',
                            'link_prefix' => false,
                            'notification_type_id' => 1,
                            'user_id' => $userId,
                            'text' => 'This system has been designed to take bookings for Hertfordshire Cubs. Thank-you for signing up.',
                            'notification_header' => 'Welcome to the Herts Cubs Booking System',
                            'notification_source' => 'System Generated',
                            'new' => 1];

            $notification = $this->Notifications->newEntity();

            $notification = $this->Notifications->patchEntity($notification, $welcomeData);

            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('Welcome to the Booking System. We have sent a welcome email.'));

                $this->getMailer('User')->send('welcome', [$user, $group, $notification]);

                /*$email = new Email('default');
                $email->template('welcome', 'default')
                    ->emailFormat('html')
                    ->to([$user->email => $user->full_name])
                    ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
                    ->subject('Welcome to the Hertfordshire Cubs Booking System')
                    ->setHeaders(['X-MC-Tags' => 'WelcomeEmail,Type1,Notification'
                        , 'X-MC-AutoText' => true
                        , 'X-MC-GoogleAnalytics' => 'hertscubs100.uk,hertscubs.uk,hcbooking.uk,booking.hertscubs100.uk,champions.hertscubs100.uk,booking.hertscubs.uk'
                        , 'X-MC-GoogleAnalyticsCampaign' => 'Welcome_Email'
                        , 'X-MC-TrackingDomain' => 'track.hertscubs.uk' ])
                    ->viewVars(['username' => $user->username
                        , 'date_created' => $user->created
                        , 'full_name' => $user->full_name
                        , 'scoutgroup' => $group->scoutgroup
                        , 'link_controller' => $notification->link_controller
                        , 'link_action' => $notification->link_action
                        , 'link_id' => $notification->link_id
                        , 'link_prefix' => $notification->link_prefix
                        , 'notification_id' => $notification->id
                        ])
                    ->helpers(['Html', 'Text', 'Time'])
                    ->send();*/

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Parameters were not set!'));

            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Create an Event Logistic
     *
     * @return \Cake\Http\Response|void
     */
    public function newLogistic()
    {
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $notification_types = $this->Notifications->NotificationTypes->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users', 'notification_types'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Create a Reset
     *
     * @return \Cake\Http\Response|null
     */
    public function newReset()
    {
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $notification_types = $this->Notifications->NotificationTypes->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users', 'notification_types'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Notify Invoice
     *
     * @param int $invoiceId The ID of the Invoice to be Notified
     * @return \Cake\Http\Response|void
     */
    public function invoice($invoiceId = null)
    {
        if (isset($invoiceId)) {
            $users = TableRegistry::get('Users');
            $groups = TableRegistry::get('Scoutgroups');
            $invoices = TableRegistry::get('Invoices');
            $payments = TableRegistry::get('Payments');

            $invoice = $invoices->get($invoiceId);

            $user = $users->get($invoice->user_id, ['contain' => ['Scoutgroups']]);
            $group = $groups->get($user->scoutgroup_id);

            $invoiceData = ['link_id' => $invoice->id,
                            'link_controller' => 'Invoices',
                            'link_action' => 'view',
                            'notification_type_id' => 6,
                            'user_id' => $invoice->user_id,
                            'text' => 'Please see the attached invoice',
                            'notification_header' => 'Invoice attached',
                            'notification_source' => 'Admin Triggered',
                            'new' => 1];

            $notification = $invoiceData;

            $this->getMailer('Invoice')->send('invoice', [$user, $group, $invoice, $notification]);

            $sets = TableRegistry::get('Settings');

            $jsonInv = json_encode($invoiceData);
            $pApiKey = $sets->get(13)->text;
            $projectId = $sets->get(14)->text;
            $eventType = 'NewPayment';

            $keenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $eventType . '?api_key=' . $pApiKey;

            $http = new Client();
            $response = $http->post(
                $keenURL,
                $jsonInv,
                ['type' => 'json']
            );

            $genericType = 'Notification';

            $keenGenURL = 'https://api.keen.io/3.0/projects/' . $projectId . '/events/' . $genericType . '?api_key=' . $pApiKey;

            $http = new Client();
            $response = $http->post(
                $keenGenURL,
                $jsonInv,
                ['type' => 'json']
            );

            $this->Flash->success(__('Invoice Delivered.'));
        } else {
            $this->Flash->error(__('Parameters were not set!'));

            return $this->redirect(['controller' => 'Landing', 'action' => 'admin_home']);
        }
    }

    /**
     * Edit method
     *
     * @param int $notificationId Notification id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($notificationId = null)
    {
        $notification = $this->Notifications->get($notificationId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $notification_types = $this->Notifications->NotificationTypes->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users', 'notification_types'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Delete method
     *
     * @param int $notificationId Notification id.
     * @return \Cake\Http\Response Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($notificationId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($notificationId);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
