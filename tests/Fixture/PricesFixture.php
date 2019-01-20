<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PricesFixture
 *
 */
class PricesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'item_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'event_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'max_number' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'value' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'description' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'prices_item_type_id' => ['type' => 'index', 'columns' => ['item_type_id'], 'length' => []],
            'prices_event_id' => ['type' => 'index', 'columns' => ['event_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'prices_event_id' => ['type' => 'foreign', 'columns' => ['event_id'], 'references' => ['events', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'prices_item_type_id' => ['type' => 'foreign', 'columns' => ['item_type_id'], 'references' => ['item_types', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'item_type_id' => 1,
            'event_id' => 2,
            'max_number' => 6,
            'value' => 20,
            'description' => 'Team Booking Price'
        ],
        [
            'item_type_id' => 2,
            'event_id' => 3,
            'max_number' => 5,
            'value' => 25,
            'description' => 'Cub Price'
        ],
        [
            'item_type_id' => 3,
            'event_id' => 3,
            'max_number' => 2,
            'value' => 30,
            'description' => 'Beaver Price'
        ],
        [
            'item_type_id' => 4,
            'event_id' => 3,
            'max_number' => 3,
            'value' => 35,
            'description' => 'Scout Price'
        ],
        [
            'item_type_id' => 5,
            'event_id' => 3,
            'max_number' => 3,
            'value' => 10,
            'description' => 'Explorer Price'
        ],
        [
            'item_type_id' => 6,
            'event_id' => 3,
            'max_number' => 10,
            'value' => 15,
            'description' => 'Adult Price'
        ],
    ];
}
