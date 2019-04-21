<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ScoutgroupsFixture
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
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'scoutgroup' => '12th Letchworth',
                'district_id' => 1,
                'number_stripped' => 1,
                'deleted' => null
            ],
            [
                'scoutgroup' => '4th Octopus',
                'district_id' => 2,
                'number_stripped' => 4,
                'deleted' => null
            ],
            [
                'scoutgroup' => '1st Llamaland',
                'district_id' => 1,
                'number_stripped' => 1,
                'deleted' => null
            ],
            [
                'scoutgroup' => '11th Goatface',
                'district_id' => 2,
                'number_stripped' => 11,
                'deleted' => null
            ],
        ];
        parent::init();
    }
}
