<?

namespace App\Mailer;

use Cake\Mailer\Mailer;

class InvoiceMailer extends Mailer
{
    public function invoice($user = null, $group = null, $notification = null, $invoice = null, $payment = null) {
        // $email = new Email('default');
        if (isset($user) && isset($group) && isset($notification) && isset($invoice->id) && isset($invoice) && isset($group)) {

            $invoiceId = $invoice->id;

            $invoiceName = 'Invoice ' . strval($invoiceId) . '.pdf';
            $invoiceLocation = FILES . 'invoice' . strval($invoiceId) . '.pdf';

            $this->template('payment', 'default')
                ->emailFormat('html')
                ->to([$user->email => $user->full_name])
                ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
                ->subject('New Payment Received')
                ->setHeaders(['X-MC-Tags' => 'PaymentEmail,Type2,Notification'
                        , 'X-MC-AutoText' => true
                        , 'X-MC-GoogleAnalytics' => 'hertscubs100.uk,hertscubs.uk,hcbooking.uk,booking.hertscubs100.uk,champions.hertscubs100.uk,booking.hertscubs.uk'
                        , 'X-MC-GoogleAnalyticsCampaign' => 'Payment_Email'
                        , 'X-MC-TrackingDomain' => 'track.hertscubs.uk' ])
                ->viewVars(['username' => $user->username
                        , 'date_created' => $user->created
                        , 'full_name' => $user->full_name
                        , 'scoutgroup' => $group->scoutgroup
                        , 'link_controller' => $notification->link_controller
                        , 'link_action' => $notification->link_action
                        , 'link_id' => $notification->link_id
                        , 'initialvalue' => $invoice->initialvalue
                        , 'value' => $invoice->value
                        , 'balance' => $invoice->balance
                        ])
                ->helpers(['Html', 'Text', 'Time'])
                ->attachments([$invoiceName => $invoiceLocation]);
                //->send(); 
        }
                                 
    }
}