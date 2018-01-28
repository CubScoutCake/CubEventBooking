<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SectionsFixture
 *
 */
class SectionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'section' => ['type' => 'string', 'length' => 255, 'default' => 'Cubs', 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'section_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'scoutgroup_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'validated' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'cc_users' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_atts' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_apps' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'sections_section_type_id' => ['type' => 'index', 'columns' => ['section_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'sections_scoutgroup_id' => ['type' => 'foreign', 'columns' => ['scoutgroup_id'], 'references' => ['scoutgroups', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'sections_section_type_id' => ['type' => 'foreign', 'columns' => ['section_type_id'], 'references' => ['section_types', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public function init()
    {
        $this->records = [

            [
                'created' => date_format(date_sub(date_create('2016-12-26 21:22:30'), date_interval_create_from_date_string("3 days")), 'Y-m-d H:i:s'),
                'modified' => date_format(date_sub(date_create('2016-12-26 21:22:30'), date_interval_create_from_date_string("3 days")), 'Y-m-d H:i:s'),
                'deleted' => null,
                'section' => 'Lorem ipsum dolor sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => true,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
            ],
            [
                'created' => date_format(date_sub(date_create('2016-12-26 20:22:30'), date_interval_create_from_date_string("3 days")), 'Y-m-d H:i:s'),
                'modified' => date_format(date_sub(date_create('2016-12-26 21:22:30'), date_interval_create_from_date_string("2 days")), 'Y-m-d H:i:s'),
                'deleted' => date_format(date_sub(date_create('2016-12-26 21:22:30'), date_interval_create_from_date_string("1 days")), 'Y-m-d H:i:s'),
                'section' => 'Lorem ipsum uj sit amet',
                'section_type_id' => 1,
                'scoutgroup_id' => 1,
                'validated' => true,
                'cc_users' => null,
                'cc_atts' => null,
                'cc_apps' => null,
            ],
        ];
        parent::init();
    }
}
