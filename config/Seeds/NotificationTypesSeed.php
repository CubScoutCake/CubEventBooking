<?php

use Migrations\AbstractSeed;

/**
 * Notificationtypes seed.
 */
class NotificationtypesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'notification_type' => 'Welcome',
                'notification_description' => 'Welcome to the System Email & Notification.',
                'icon' => 'fa-user',
            ],
            [
                'id' => '2',
                'notification_type' => 'New Payment Received',
                'notification_description' => 'Notification that a payment has been recorded by an administrator.',
                'icon' => 'fa-gbp',
            ],
            [
                'id' => '3',
                'notification_type' => 'Possible Duplicate Invoices',
                'notification_description' => 'This can be triggered, when an application has more than one invoice associated and it is not clear why.',
                'icon' => null,
            ],
            [
                'id' => '4',
                'notification_type' => 'Possible Missing Invoice',
                'notification_description' => 'This can be triggered, when an otherwise complete application does not have an invoice associated to it and it is not clear why.',
                'icon' => null,
            ],
            [
                'id' => '5',
                'notification_type' => 'Deposit Outstanding',
                'notification_description' => 'Notification of an Invoice where the deposit is past due.',
                'icon' => 'fa-gbp',
            ],
            [
                'id' => '6',
                'notification_type' => 'Invoice Attached',
                'notification_description' => 'Invoice is attached to the email.',
                'icon' => '',
            ],
            [
                'id' => '7',
                'notification_type' => 'Password Reset',
                'notification_description' => 'A password reset password has been triggered.',
                'icon' => 'fa-unlock',
            ],
            [
                'id' => '8',
                'notification_type' => 'Outstanding Balance',
                'notification_description' => 'Balance Outstanding on Invoice',
                'icon' => 'fa-money',
            ],
            [
                'id' => '9',
                'notification_type' => 'Surcharge Added',
                'notification_description' => 'A Payment Surcharge was added to the Invoice.',
                'icon' => 'fa-money',
            ],
        ];

        $table = $this->table('notification_types');
        $table->insert($data)->save();
    }
}
