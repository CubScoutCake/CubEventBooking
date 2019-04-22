<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationStatusesFixture
 */
class ApplicationStatusesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'application_status' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'no_money' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'reserved' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'attendees_added' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
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
                'application_status' => 'New',
                'active' => 1,
                'no_money' => 1,
                'reserved' => 0,
                'attendees_added' => 0
            ],
            [
                'application_status' => 'Cancelled',
                'active' => 0,
                'no_money' => 1,
                'reserved' => 0,
                'attendees_added' => 0
            ],
            [
                'application_status' => 'Reserved',
                'active' => 1,
                'no_money' => 1,
                'reserved' => 1,
                'attendees_added' => 0
            ],
            [
                'application_status' => 'Awaiting Payment',
                'active' => 1,
                'no_money' => 1,
                'reserved' => 0,
                'attendees_added' => 1
            ],
            [
                'application_status' => 'Complete',
                'active' => 1,
                'no_money' => 0,
                'reserved' => 0,
                'attendees_added' => 1
            ],
        ];
        parent::init();
    }
}
