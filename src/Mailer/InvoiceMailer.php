<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Core\Configure;
use Cake\Mailer\Mailer;

class InvoiceMailer extends Mailer
{
    /**
     * An invoice Mailer - Attaching the Invoice to the User Email.
     *
     * @param \Cake\ORM\Entity $user The User which is being sent the Email.
     * @param \Cake\ORM\Entity $group The Scout Group, the User is part of.
     * @param \Cake\ORM\Entity $notification The Notification Entity.
     * @param \Cake\ORM\Entity $invoice The Invoice being sent.
     * @param \Cake\ORM\Entity $payment The Payment being included.
     *
     * @return void
     */
    public function invoice($user = null, $group = null, $notification = null, $invoice = null, $payment = null)
    {
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
                ->setDomain(Configure::read('App.domain'))
                ->viewVars(['username' => $user->username,
                         'date_created' => $user->created,
                         'full_name' => $user->full_name,
                         'scoutgroup' => $group->scoutgroup,
                         'link_controller' => $notification->link_controller,
                         'link_action' => $notification->link_action,
                         'link_id' => $notification->link_id,
                         'initial_value' => $invoice->initial_value,
                         'paid_value' => $invoice->paid_value,
                         'balance' => $invoice->balance,
                        ])
                ->helpers(['Html', 'Text', 'Time'])
                ->attachments([$invoiceName => $invoiceLocation]);
                //->send();
        }
    }
}
