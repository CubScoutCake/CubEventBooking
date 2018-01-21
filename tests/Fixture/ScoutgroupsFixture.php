<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ScoutgroupsFixture
 *
 */
class ScoutgroupsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'scoutgroup' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'district_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'number_stripped' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'scoutgroups_district_id' => ['type' => 'index', 'columns' => ['district_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'scoutgroups_scoutgroup' => ['type' => 'unique', 'columns' => ['scoutgroup'], 'length' => []],
            'scoutgroups_district_id' => ['type' => 'foreign', 'columns' => ['district_id'], 'references' => ['districts', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'scoutgroup' => 'Lorem ipsum dolor sit amet',
            'district_id' => 1,
            'number_stripped' => 1,
            'deleted' => null
        ],
        [
            'id' => 2,
            'scoutgroup' => 'Lorem ipsum dolor aorumn amet',
            'district_id' => 2,
            'number_stripped' => 1,
            'deleted' => null
        ],
        [
            'id' => 3,
            'scoutgroup' => 'Lorem ipsum tempis sit amet',
            'district_id' => 1,
            'number_stripped' => 1,
            'deleted' => 1481983190
        ],
        [
            'id' => 4,
            'scoutgroup' => 'Lorem tempis dolor sit amet',
            'district_id' => 2,
            'number_stripped' => 1,
            'deleted' => 1481983190
        ],
    ];
}
