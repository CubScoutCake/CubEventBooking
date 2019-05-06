<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventTypesTable Test Case
 */
class EventTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventTypesTable
     */
    public $EventTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EventTypes',
        'app.settingtypes',
        'app.Settings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EventTypes') ? [] : ['className' => EventTypesTable::class];
        $this->EventTypes = TableRegistry::getTableLocator()->get('EventTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->EventTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'event_type' => 'Leader',
                'simple_booking' => true,
                'date_of_birth' => true,
                'medical' => true,
                'parent_applications' => false,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => true,
                'permit_holder' => true,
                'team_leader' => true,
                'sync_book' => true,
                'payable_setting_id' => 7,
                'dietary' => true,
                'hold_booking' => true,
                'attendee_booking' => true,
                'district_booking' => true,
            ],
            [
                'id' => 2,
                'event_type' => 'Parent',
                'simple_booking' => false,
                'date_of_birth' => false,
                'medical' => true,
                'parent_applications' => true,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => true,
                'permit_holder' => false,
                'team_leader' => false,
                'sync_book' => false,
                'payable_setting_id' => 7,
                'dietary' => true,
                'hold_booking' => false,
                'attendee_booking' => false,
                'district_booking' => false,
            ],
            [
                'id' => 3,
                'event_type' => 'To Delete',
                'simple_booking' => false,
                'date_of_birth' => false,
                'medical' => 1,
                'dietary' => 1,
                'parent_applications' => true,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => true,
                'permit_holder' => false,
                'team_leader' => false,
                'sync_book' => false,
                'payable_setting_id' => 7,
                'hold_booking' => false,
                'attendee_booking' => false,
                'district_booking' => false,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
