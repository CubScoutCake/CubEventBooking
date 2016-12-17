<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RolesFixture
 *
 */
class RolesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'role' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'invested' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'minor' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'automated' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'id' => 1,
            'role' => 'Lorem ipsum dolor sit amet',
            'invested' => 1,
            'minor' => 1,
            'automated' => 1,
            'deleted' => null
        ],
        [
            'id' => 2,
            'role' => 'Lorem ipsum dolor sit amet',
            'invested' => 0,
            'minor' => 0,
            'automated' => 0,
            'deleted' => null
        ],
        [
            'id' => 3,
            'role' => 'Lorem ipsum dolor sit amet',
            'invested' => 0,
            'minor' => 0,
            'automated' => 0,
            'deleted' => 1481983190
        ],
        [
            'id' => 4,
            'role' => 'Lorem ipsum dolor sit amet',
            'invested' => 0,
            'minor' => 0,
            'automated' => 0,
            'deleted' => 1481983190
        ],
    ];
}
