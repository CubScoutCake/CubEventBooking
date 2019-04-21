<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsFixture
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
        'legacy_section' => ['type' => 'string', 'length' => 10, 'default' => 'Cubs', 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'permit_holder' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
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
        'section_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'team_leader' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'application_status_id' => ['type' => 'integer', 'length' => 10, 'default' => '1', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'hold_numbers' => ['type' => 'json', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'applications_user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'applications_event_id' => ['type' => 'index', 'columns' => ['event_id'], 'length' => []],
            'applications_section_id' => ['type' => 'index', 'columns' => ['section_id'], 'length' => []],
            'applications_application_status_id' => ['type' => 'index', 'columns' => ['application_status_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'applications_application_status_id_fkey' => ['type' => 'foreign', 'columns' => ['application_status_id'], 'references' => ['application_statuses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'applications_event_id' => ['type' => 'foreign', 'columns' => ['event_id'], 'references' => ['events', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'applications_section_id' => ['type' => 'foreign', 'columns' => ['section_id'], 'references' => ['sections', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'applications_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'user_id' => 1,
                'section_id' => 1,
                'application_status_id' => 1,
                'permit_holder' => 'Lorem as dolor sit amet',
                'team_leader' => 'Lorem as dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
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
                'deleted' => null,
                'hold_numbers' => ''
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'application_status_id' => 1,
                'permit_holder' => 'Lorem dolor sit amet',
                'team_leader' => 'Lorem as dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
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
                'deleted' => 1481841289,
                'hold_numbers' => ''
            ],
            [
                'user_id' => 1,
                'section_id' => 1,
                'application_status_id' => 1,
                'permit_holder' => 'Lorem as dolor sit amet',
                'team_leader' => 'Lorem as dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'modification' => 1,
                'event_id' => 3,
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
                'deleted' => null,
                'hold_numbers' => ''
            ],
        ];
        parent::init();
    }
}
