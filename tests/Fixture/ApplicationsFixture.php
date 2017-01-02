<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsFixture
 *
 */
class ApplicationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'section_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'permitholder' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modification' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'event_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'osm_event_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_att_total' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_att_cubs' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_att_yls' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_att_leaders' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_inv_count' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_inv_total' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_inv_cubs' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_inv_yls' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_inv_leaders' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'applications_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'applications_section_id' => ['type' => 'index', 'columns' => ['section_id'], 'length' => []],
            'applications_event_id' => ['type' => 'index', 'columns' => ['event_id'], 'length' => []],],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'applications_event_id' => ['type' => 'foreign', 'columns' => ['event_id'], 'references' => ['events', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'applications_section_id' => ['type' => 'foreign', 'columns' => ['section_id'], 'references' => ['sections', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'applications_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'user_id' => 1,
            'section_id' => 1,
            'permitholder' => 'Lorem as dolor sit amet',
            'created' => 1481841289,
            'modified' => 1481841289,
            'modification' => 1,
            'event_id' => 1,
            'osm_event_id' => 1,
            'cc_att_total' => 1,
            'cc_att_cubs' => 1,
            'cc_att_yls' => 1,
            'cc_att_leaders' => 1,
            'cc_inv_count' => 1,
            'cc_inv_total' => 1,
            'cc_inv_cubs' => 1,
            'cc_inv_yls' => 1,
            'cc_inv_leaders' => 1,
            'deleted' => null
        ],
        [
            'id' => 2,
            'user_id' => 1,
            'section_id' => 1,
            'permitholder' => 'Lorem dolor sit amet',
            'created' => 1481841289,
            'modified' => 1481841289,
            'modification' => 1,
            'event_id' => 2,
            'osm_event_id' => 1,
            'cc_att_total' => 1,
            'cc_att_cubs' => 1,
            'cc_att_yls' => 1,
            'cc_att_leaders' => 1,
            'cc_inv_count' => 1,
            'cc_inv_total' => 1,
            'cc_inv_cubs' => 1,
            'cc_inv_yls' => 1,
            'cc_inv_leaders' => 1,
            'deleted' => 1481841289
        ],
    ];
}
