<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemTypesFixture
 *
 */
class ItemTypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'item_type' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'role_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'minor' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'cancelled' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'available' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'team_price' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'item_types_role_id' => ['type' => 'index', 'columns' => ['role_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'item_types_role_id' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'item_type' => 'Team Booking',
            'role_id' => null,
            'minor' => false,
            'cancelled' => false,
            'available' => true,
            'team_price' => true,
        ],
        [
            'item_type' => 'Cub Item Type',
            'role_id' => 3,
            'minor' => true,
            'cancelled' => false,
            'available' => true,
            'team_price' => false,
        ],
	    [
		    'item_type' => 'Beaver Item Type',
		    'role_id' => 2,
		    'minor' => true,
		    'cancelled' => false,
		    'available' => true,
		    'team_price' => false,
	    ],
	    [
		    'item_type' => 'Scout Item Type',
		    'role_id' => 4,
		    'minor' => true,
		    'cancelled' => false,
		    'available' => true,
		    'team_price' => false,
	    ],
	    [
		    'item_type' => 'YL Item Type',
		    'role_id' => 5,
		    'minor' => true,
		    'cancelled' => false,
		    'available' => true,
		    'team_price' => false,
	    ],
	    [
		    'item_type' => 'Adult Item Type',
		    'role_id' => 1,
		    'minor' => false,
		    'cancelled' => false,
		    'available' => true,
		    'team_price' => false,
	    ],
    ];
}
