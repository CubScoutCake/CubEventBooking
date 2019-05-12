<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotificationTypesFixture
 */
class NotificationTypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'notification_type' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'notification_description' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'icon' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'notification_type' => 'Welcome',
                'notification_description' => 'Welcome to the System Email & Notification.',
                'icon' => 'fa-user'
            ],
            [
                'notification_type' => 'Password Reset',
                'notification_description' => 'A password reset password has been triggered.',
                'icon' => 'fa-unlock'
            ],
            [
                'notification_type' => 'New Payment Received',
                'notification_description' => 'Notification that a payment has been recorded by an administrator.',
                'icon' => 'fa-receipt'
            ],
            [
                'notification_type' => 'Surcharge Added',
                'notification_description' => 'A Payment Surcharge was added to the Invoice.',
                'icon' => 'fa-tag'
            ],
            [
                'notification_type' => 'Outstanding Balance',
                'notification_description' => 'Balance Outstanding on Invoice',
                'icon' => 'fa-clock'
            ],
            [
                'notification_type' => 'Invoice Attached',
                'notification_description' => 'Invoice is attached to the email.',
                'icon' => 'fa-paperclip'
            ],
            [
                'notification_type' => 'Deposit Outstanding',
                'notification_description' => 'Notification of an Invoice where the deposit is past due.',
                'icon' => 'fa-clock'
            ],
            [
                'notification_type' => 'Reservation Confirmed',
                'notification_description' => 'Notification of an Invoice where the deposit is past due.',
                'icon' => 'fa-ticket-alt'
            ],
            [
                'notification_type' => 'Reservation Payment Received',
                'notification_description' => 'Notification that a payment has been recorded by an administrator.',
                'icon' => 'fa-receipt'
            ],
        ];
        parent::init();
    }
}
