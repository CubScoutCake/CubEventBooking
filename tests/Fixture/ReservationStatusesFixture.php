<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationStatusesFixture
 */
class ReservationStatusesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'reservation_status' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'complete' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'cancelled' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'status_order' => ['type' => 'integer', 'length' => 10, 'default' => '0', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
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
                'reservation_status' => 'Pending Payment',
                'active' => true,
                'complete' => false,
                'cancelled' => false,
                'status_order' => 1,
            ],
            [
                'reservation_status' => 'Complete',
                'active' => true,
                'complete' => true,
                'cancelled' => false,
                'status_order' => 3,
            ],
            [
                'reservation_status' => 'Expired',
                'active' => false,
                'complete' => false,
                'cancelled' => true,
                'status_order' => 0,
            ],
            [
                'reservation_status' => 'Cancelled',
                'active' => false,
                'complete' => false,
                'cancelled' => true,
                'status_order' => 0,
            ],
        ];
        parent::init();
    }
}
