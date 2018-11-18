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
        'app.event_types',
        'app.settingtypes',
        'app.settings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EventTypes') ? [] : ['className' => 'App\Model\Table\EventTypesTable'];
        $this->EventTypes = TableRegistry::get('EventTypes', $config);
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
                'event_type' => 'Lorem ipsum dolor sit amet',
                'simple_booking' => true,
                'date_of_birth' => true,
                'medical' => true,
                'parent_applications' => true,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => true,
                'permit_holder' => true,
                'team_leader' => true,
                'sync_book' => true,
                'payable_setting_id' => 7,
            ],
            [
                'id' => 2,
                'event_type' => 'Lorem ipsum Gog sit amet',
                'simple_booking' => true,
                'date_of_birth' => true,
                'medical' => true,
                'parent_applications' => true,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => true,
                'permit_holder' => true,
                'team_leader' => true,
                'sync_book' => true,
                'payable_setting_id' => 7,
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
