<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventStatusesFixture
 */
class EventStatusesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'event_status' => ['type' => 'string', 'length' => 255, 'default' => false, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'live' => ['type' => 'boolean', 'length' => null, 'default' => false, 'null' => false, 'comment' => null, 'precision' => null],
        'accepting_applications' => ['type' => 'boolean', 'length' => null, 'default' => false, 'null' => false, 'comment' => null, 'precision' => null],
        'spaces_full' => ['type' => 'boolean', 'length' => null, 'default' => false, 'null' => false, 'comment' => null, 'precision' => null],
        'pending_date' => ['type' => 'boolean', 'length' => null, 'default' => false, 'null' => false, 'comment' => null, 'precision' => null],
        'status_order' => ['type' => 'integer', 'length' => 10, 'default' => 1, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
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
                'event_status' => 'Live',
                'live' => true,
                'accepting_applications' => true,
                'spaces_full' => true,
                'pending_date' => true,
                'status_order' => 1
            ],
        ];
        parent::init();
    }
}
