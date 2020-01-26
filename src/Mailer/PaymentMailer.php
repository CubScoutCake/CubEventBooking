<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Core\Configure;
use Cake\Mailer\Mailer;

class PaymentMailer extends Mailer
{
    /**
     * A Payment notification receipt mailer.
     *
     * @param \Cake\ORM\Entity $user The User Entity.
     * @param \Cake\ORM\Entity $group The Scout Group Entity
     * @param \Cake\ORM\Entity $notification The notification Entity
     * @param \Cake\ORM\Entity $invoice The invoice being referenced.
     * @param \Cake\ORM\Entity $payment The payment received.
     *
     * @return void
     */
    public function payment($user = null, $group = null, $notification = null, $invoice = null, $payment = null)
    {
        // $email = new Email('default');
        if (isset($user) && isset($group) && isset($payment) && isset($notification) && isset($invoice) && isset($group)) {
            $this->transport('sparkpost')
                ->template('payment', 'default')
                ->setDomain(Configure::read('App.domain'))
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
                    'link_prefix' => $notification->link_prefix,
                    'notification_id' => $notification->id,
                    'initial_value' => $invoice->initial_value,
                    'paid_value' => $invoice->paid_value,
                    'payment_value' => $payment->value,
                    'payment_id' => $payment->id,
                    'invoice_id' => $invoice->id,
                    'balance' => $invoice->balance,
                ])
                ->helpers(['Html', 'Text', 'Time']);
            //->send();
        }
    }

    /**
     * A mailer to send an outstanding email to payments outstanding.
     *
     * @param \Cake\ORM\Entity $user The User who owns the Outstanding Invoice.
     * @param \Cake\ORM\Entity $group The Scout Group of the Application.
     * @param \Cake\ORM\Entity $notification The Notification of outstanding Payment.
     * @param \Cake\ORM\Entity $invoice The Invoice Outstanding.
     * @param \Cake\ORM\Entity $app The Application with an invoice Outstanding.
     *
     * @return void
     */
    public function outstanding($user = null, $group = null, $notification = null, $invoice = null, $app = null)
    {
        // $email = new Email('default');
        if (isset($user) && isset($group) && isset($app) && isset($notification) && isset($invoice) && isset($group)) {
            $this->transport('sparkpost')
                ->template('outstanding', 'default')
                ->emailFormat('html')
                ->to([$user->email => $user->full_name])
                ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
                ->subject('Balance OUTSTANDING')
                ->viewVars(['username' => $user->username,
                     'date_created' => $user->created,
                     'full_name' => $user->full_name,
                     'scoutgroup' => $group->scoutgroup,
                     'link_controller' => $notification->link_controller,
                     'link_action' => $notification->link_action,
                     'link_id' => $notification->link_id,
                     'link_prefix' => $notification->link_prefix,
                     'notification_id' => $notification->id,
                     'initial_value' => $invoice->initial_value,
                     'paid_value' => $invoice->paid_value,
                     'invoice_id' => $invoice->id,
                     'balance' => $invoice->balance,
                ])
                ->helpers(['Html', 'Text', 'Time']);
            //->send();
        }
    }

    /**
     * A mailer notification which sends a surcharge notification,
     *
     * @param \Cake\ORM\Entity $user The User Entity.
     * @param \Cake\ORM\Entity $group The Scout Group of the User.
     * @param \Cake\ORM\Entity $notification The Surcharge Notification.
     * @param \Cake\ORM\Entity $invoice The Invoice to which the charge has been added.
     * @param \Cake\ORM\Entity $app The Application where the Inv
     * @param \App\Mailer\number $percentage The Percentage of the Charge.
     * @param \App\Mailer\number $fee The Total fee.
     *
     * @return void
     */
    public function surcharge($user = null, $group = null, $notification = null, $invoice = null, $app = null, $percentage = null, $fee = null)
    {
        // $email = new Email('default');
        if (isset($user) && isset($group) && isset($app) && isset($notification) && isset($invoice) && isset($fee) && isset($percentage) && isset($group)) {
            $this->transport('sparkpost')
                ->template('surcharge', 'default')
                ->emailFormat('html')
                ->to([$user->email => $user->full_name])
                ->from(['info@hertscubs.uk' => 'HertsCubs Booking Site'])
                ->subject('Late Payment Surcharge of ' . $percentage . '% was added to Invoice.')
                ->viewVars(['username' => $user->username,
                    'date_created' => $user->created,
                    'full_name' => $user->full_name,
                    'scoutgroup' => $group->scoutgroup,
                    'link_controller' => $notification->link_controller,
                    'link_action' => $notification->link_action,
                    'link_id' => $notification->link_id,
                    'link_prefix' => $notification->link_prefix,
                    'notification_id' => $notification->id,
                    'initial_value' => $invoice->initial_value,
                    'paid_value' => $invoice->paid_value,
                    'invoice_id' => $invoice->id,
                    'balance' => $invoice->balance,
                    'percentage' => $percentage,
                    'fee' => $fee,
                ])
                ->helpers(['Html', 'Text', 'Time']);
            //->send();
        }
    }
}
