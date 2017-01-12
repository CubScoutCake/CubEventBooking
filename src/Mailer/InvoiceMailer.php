<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\Entity;

class InvoiceMailer extends Mailer
{
    /**
     * An invoice Mailer - Attaching the Invoice to the User Email.
     *
     * @param Entity $user The User which is being sent the Email.
     * @param Entity $group The Scout Group, the User is part of.
     * @param Entity $notification The Notification Entity.
     * @param Entity $invoice The Invoice being sent.
     * @param Entity $payment The Payment being included.
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
                ->viewVars(['username' => $user->username,
                         'date_created' => $user->created,
                         'full_name' => $user->full_name,
                         'scoutgroup' => $group->scoutgroup,
                         'link_controller' => $notification->link_controller,
                         'link_action' => $notification->link_action,
                         'link_id' => $notification->link_id,
                         'initialvalue' => $invoice->initialvalue,
                         'value' => $invoice->value,
                         'balance' => $invoice->balance,
                        ])
                ->helpers(['Html', 'Text', 'Time'])
                ->attachments([$invoiceName => $invoiceLocation]);
                //->send();
        }
    }
}
