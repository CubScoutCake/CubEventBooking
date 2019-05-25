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
        'type_code' => ['type' => 'string', 'length' => 7, 'default' => 'ABC-DEF', 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
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
                'notification_type' => 'Generic',
                'notification_description' => 'Generic Notification.',
                'icon' => 'fa-envelope',
                'type_code' => 'GEN-NOT',
            ],
            [
                'notification_type' => 'Welcome',
                'notification_description' => 'Welcome to the System Email & Notification.',
                'icon' => 'fa-user',
                'type_code' => 'USR-NEW',
            ],
            [
                'notification_type' => 'Password Reset',
                'notification_description' => 'A password reset password has been triggered.',
                'icon' => 'fa-unlock',
                'type_code' => 'USR-PWD',
            ],
            [
                'notification_type' => 'New Payment Received',
                'notification_description' => 'Notification that a payment has been recorded by an administrator.',
                'icon' => 'fa-receipt',
                'type_code' => 'INV-PAY',
            ],
            [
                'notification_type' => 'Surcharge Added',
                'notification_description' => 'A Payment Surcharge was added to the Invoice.',
                'icon' => 'fa-tag',
                'type_code' => 'INV-SUR',
            ],
            [
                'notification_type' => 'Outstanding Balance',
                'notification_description' => 'Balance Outstanding on Invoice',
                'icon' => 'fa-clock',
                'type_code' => 'INV-OUT',
            ],
            [
                'notification_type' => 'Deposit Outstanding',
                'notification_description' => 'Notification of an Invoice where the deposit is past due.',
                'icon' => 'fa-clock',
                'type_code' => 'INV-DEP',
            ],
            [
                'notification_type' => 'Reservation Confirmation',
                'notification_description' => 'Reservation received, awaiting payment.',
                'icon' => 'fa-ticket-alt',
                'type_code' => 'RSV-NEW',
            ],
            [
                'notification_type' => 'Reservation Payment Received',
                'notification_description' => 'Notification that a payment has been recorded against a Reservation by an administrator.',
                'icon' => 'fa-receipt',
                'type_code' => 'RSV-CNF',
            ],
            [
                'notification_type' => 'Reservation Expired',
                'notification_description' => 'Expiration date for Reservation Reached. Reservation is No longer Valid.',
                'icon' => 'fa-ticket-alt',
                'type_code' => 'RSV-EXP',
            ],
            [
                'notification_type' => 'Reservation Cancelled',
                'notification_description' => 'Reservation received, awaiting payment.',
                'icon' => 'fa-ticket-alt',
                'type_code' => 'RSV-CAN',
            ],
        ];
        parent::init();
    }
}
