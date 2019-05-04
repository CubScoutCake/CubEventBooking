<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventsFixture
 */
class EventsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'name' => ['type' => 'string', 'length' => 18, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'full_name' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'live' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'new_apps' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'start_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'end_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deposit' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deposit_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deposit_inc_leaders' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'logo' => ['type' => 'string', 'length' => 255, 'default' => '/Monkey.png', 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'discount_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'intro_text' => ['type' => 'string', 'length' => 999, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'location' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'max' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'allow_reductions' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'invoices_locked' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'admin_user_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'max_apps' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'max_section' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'event_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'section_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'closing_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'cc_apps' => ['type' => 'integer', 'length' => 10, 'default' => '0', 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'complete' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'cc_prices' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'team_price' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'event_status_id' => ['type' => 'integer', 'length' => 10, 'default' => '1', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'opening_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'cc_res' => ['type' => 'integer', 'length' => 10, 'default' => '0', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cc_atts' => ['type' => 'integer', 'length' => 10, 'default' => '0', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'events_discount_id' => ['type' => 'index', 'columns' => ['discount_id'], 'length' => []],
            'events_admin_user_id' => ['type' => 'index', 'columns' => ['admin_user_id'], 'length' => []],
            'events_event_type_id' => ['type' => 'index', 'columns' => ['event_type_id'], 'length' => []],
            'events_section_type_id' => ['type' => 'index', 'columns' => ['section_type_id'], 'length' => []],
            'events_event_status_id' => ['type' => 'index', 'columns' => ['event_status_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'events_admin_user_id_fkey' => ['type' => 'foreign', 'columns' => ['admin_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'events_discount_id' => ['type' => 'foreign', 'columns' => ['discount_id'], 'references' => ['discounts', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'events_event_status_id_fkey' => ['type' => 'foreign', 'columns' => ['event_status_id'], 'references' => ['event_statuses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'events_event_type_id' => ['type' => 'foreign', 'columns' => ['event_type_id'], 'references' => ['event_types', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'events_section_type_id' => ['type' => 'foreign', 'columns' => ['section_type_id'], 'references' => ['section_types', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            // Deleted Event
            [
                'name' => 'Lorem ipsum dolo',
                'full_name' => 'Lorem ipsum dolor sit amet',
                'live' => 1,
                'new_apps' => 1,
                'start_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("40 days")), 'Y-m-d H:i:s'),
                'end_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("41 days")), 'Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'deposit' => 1,
                'deposit_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("20 days")), 'Y-m-d H:i:s'),
                'deposit_inc_leaders' => 1,
                'logo' => 'Lorem ipsum dolor sit amet',
                'discount_id' => 1,
                'intro_text' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'max' => 1,
                'allow_reductions' => 1,
                'invoices_locked' => 1,
                'admin_user_id' => 5,
                'max_apps' => 1,
                'max_section' => 1,
                'deleted' => 1542670212,
                'event_type_id' => 1,
                'section_type_id' => 1,
                'closing_date' => 1542670212,
                'cc_apps' => 1,
                'complete' => 1,
                'cc_prices' => 1,
                'team_price' => 0,
                'event_status_id' => 1,
                'opening_date' => 1554730915,
                'cc_res' => 1,
                'cc_atts' => 1
            ],
            // Available Event Type 1 - Leader
            [
                'name' => 'OLD dolo',
                'full_name' => 'Lorem Goat dolor sit amet',
                'live' => 1,
                'new_apps' => 1,
                'start_date' => date_format(date_sub(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("40 days")), 'Y-m-d H:i:s'),
                'end_date' => date_format(date_sub(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("41 days")), 'Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'deposit' => 1,
                'deposit_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("20 days")), 'Y-m-d H:i:s'),
                'deposit_inc_leaders' => 1,
                'logo' => 'Lorem ipsum dolor sit amet',
                'discount_id' => null,
                'intro_text' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'max' => 1,
                'allow_reductions' => 1,
                'invoices_locked' => 1,
                'admin_user_id' => 5,
                'max_apps' => 2,
                'max_section' => 20,
                'deleted' => null,
                'event_type_id' => 1,
                'section_type_id' => 2,
                'closing_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("30 days")), 'Y-m-d H:i:s'),
                'cc_apps' => 1,
                'cc_prices' => 2,
                'complete' => 0,
                'team_price' => 1,
                'event_status_id' => 1,
                'opening_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("10 days")), 'Y-m-d H:i:s'),
                'cc_res' => 1,
                'cc_atts' => 1
            ],
            // Available Event Type 2 - Parent
            [
                'name' => 'Bushcraft 109',
                'full_name' => 'CountyBushcraft',
                'live' => 1,
                'new_apps' => 1,
                'start_date' => date_format(date_sub(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("40 days")), 'Y-m-d H:i:s'),
                'end_date' => date_format(date_sub(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("41 days")), 'Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'deposit' => 0,
                'deposit_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("20 days")), 'Y-m-d H:i:s'),
                'deposit_inc_leaders' => 0,
                'logo' => 'Lorem ipsum dolor sit amet',
                'discount_id' => null,
                'intro_text' => 'Lorem ipsum dolor sit amet',
                'location' => 'Lorem ipsum dolor sit amet',
                'max' => 1,
                'allow_reductions' => 1,
                'invoices_locked' => 1,
                'admin_user_id' => 5,
                'max_apps' => 2,
                'max_section' => 1,
                'deleted' => null,
                'event_type_id' => 2,
                'section_type_id' => 2,
                'closing_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("30 days")), 'Y-m-d H:i:s'),
                'cc_apps' => 1,
                'cc_prices' => 5,
                'complete' => 0,
                'team_price' => 0,
                'event_status_id' => 1,
                'opening_date' => date_format(date_add(date_create('2016-12-26 23:22:30'), date_interval_create_from_date_string("10 days")), 'Y-m-d H:i:s'),
                'cc_res' => 1,
                'cc_atts' => 1
            ],
        ];
        parent::init();
    }
}
