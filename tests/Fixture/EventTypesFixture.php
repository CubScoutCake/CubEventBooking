<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventTypesFixture
 */
class EventTypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'event_type' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'simple_booking' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'date_of_birth' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'medical' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'dietary' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'parent_applications' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'invoice_text_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'legal_text_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'team_leader' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'permit_holder' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'display_availability' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'application_ref_id' => ['type' => 'integer', 'length' => 10, 'default' => '1', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'sync_book' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'payable_setting_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'hold_booking' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'attendee_booking' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'district_booking' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'event_types_invoice_text_id' => ['type' => 'index', 'columns' => ['invoice_text_id'], 'length' => []],
            'event_types_legal_text_id' => ['type' => 'index', 'columns' => ['legal_text_id'], 'length' => []],
            'event_types_application_ref_id' => ['type' => 'index', 'columns' => ['application_ref_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'event_types_application_ref_id' => ['type' => 'foreign', 'columns' => ['application_ref_id'], 'references' => ['settings', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'event_types_payable_setting_id' => ['type' => 'foreign', 'columns' => ['payable_setting_id'], 'references' => ['settings', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'event_type' => 'Lorem ipsum dolor sit amet',
                'simple_booking' => 1,
                'date_of_birth' => 1,
                'medical' => 1,
                'dietary' => 1,
                'parent_applications' => 1,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => 1,
                'permit_holder' => 1,
                'team_leader' => 1,
                'sync_book' => 1,
                'payable_setting_id' => 7,
                'hold_booking' => 1,
                'attendee_booking' => 1,
                'district_booking' => 1
            ],
            [
                'event_type' => 'Lorem ipsum Gog sit amet',
                'simple_booking' => 1,
                'date_of_birth' => 1,
                'medical' => 1,
                'dietary' => 1,
                'parent_applications' => 1,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => 1,
                'permit_holder' => 1,
                'team_leader' => 1,
                'sync_book' => 1,
                'payable_setting_id' => 7,
                'hold_booking' => 1,
                'attendee_booking' => 1,
                'district_booking' => 1
            ],
        ];
        parent::init();
    }
}
