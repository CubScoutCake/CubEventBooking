<?php
namespace App\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\Component;
use Cake\Mailer\Email;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;

class AlertComponent extends Component
{
    public $components = ['Flash', 'Progress'];

    use MailerAwareTrait;

    /**
     * @param int $userID The User ID to be loaded
     * @return void
     */
    public function appLoad($userID)
    {
        if (!is_null($userID)) {
            $notificationTable = TableRegistry::get('Notifications');
            $controller = $this->_registry->getController();

            $notificationEnts = $notificationTable->find('unread')->where(['user_id' => $userID]);
            $notificationCount = $notificationEnts->count();

            $unreadNotifications = false;

            if (isset($notificationCount) && $notificationCount > 0) {
                $unreadNotifications = true;
            }

            $controller->set(compact('unreadNotifications'));

            //$userAppProgress = 'appProgress' . $userID;
            //$appProgress = Cache::read($userAppProgress);

            if (empty($appProgress)) {
                //$this->loadComponent('Progress');
                //$this->Progress->cacheApps($userID);
            }
            //$controller->set(compact('appProgress'));
        }
    }

    /**
     * App Query
     *
     * @param int $appID to be Queried
     * @return mixed
     */
    public function queryApp($appID)
    {
        if (isset($appID)) {
            $this->loadComponent('Progress');

            $this->Progress->determineApp($appID, true, null, false, true, false);

            if ($results->done != 1) {
                // Application is incomplete for one of four reasons 1: Missing an Application, 2: Number of Cubs doesn't match, 3: Number of Leaders doesn't match, 4: Payment is incomplete.

                $issues = [];
                $issueKeys = [];

                // Check 1 - does it have an invoice
                if ($results->invDone != 1 && $results->invCount != 1) {
                    arraypush($issues, 'An invoice has not been generated.');
                    arraypush($issueKeys, 0);
                }

                // Check 2 - does it have the right number of Cubs
                if ($results->cubsDone != 1 || $results->invCubs != $results->attCubs) {
                    arraypush($issues, 'There are Cubs names missing or some that have not been cancelled on the invoice.');
                    arraypush($issueKeys, 1);

                    arraypush($issues, 'There are more Cubs names on the application than invoiced for.');
                    arraypush($issueKeys, 2);
                }

                // Check 3 - does it have the right number of Leaders & YLs
                if ($results->cubsNotDone != 1 || $results->invNotCubs != $results->attNotCubs) {
                    arraypush($issues, 'There are Young Leaders names missing or some that have not been cancelled on the invoice.');
                    arraypush($issueKeys, 3);

                    arraypush($issues, 'There are more Young Leaders names on the application than invoiced for.');
                    arraypush($issueKeys, 4);

                    arraypush($issues, 'There are Leaders names missing or some that have not been cancelled on the invoice.');
                    arraypush($issueKeys, 5);

                    arraypush($issues, 'There are more Leaders names on the application than invoiced for.');
                    arraypush($issueKeys, 6);
                }

                // Check 4 - is it all paid up
                if ($results->payDone != 1 && $sumValues != $sumPayments) {
                    arraypush($issues, 'Payment is Outstanding');
                    arraypush($issueKeys, 7);
                }

                $notification = $this->Notifications->newEntity();

                $notification = $this->Notifications->patchEntity($notification, $invoiceData);

                if ($this->Notifications->save($notification)) {
                    $notificationId = $notification->get('id');

                    $noteData = [
                        'note_text' => 'A Balance Outstanding Prompt Email was Sent with Notification id #' . $notificationId,
                        'visible' => false,
                        'user_id' => $user->id,
                        'invoice_id' => $invoice->id,
                        'application_id' => $app->id
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
                }
            }
        }
    }
}
