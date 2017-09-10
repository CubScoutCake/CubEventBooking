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
        'app.events',
        'app.password_states',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.invoices',
        'app.invoice_items',
        'app.item_types',
        'app.prices',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.logistic_items',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.event_types',
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
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'event_type' => 'Lorem ipsum dolor sit amet',
                'simple_booking' => 1,
                'date_of_birth' => 1,
                'medical' => 1,
                'parent_applications' => 1,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => 1,
                'permit_holder' => 1,
                'team_leader' => 1,
                'sync_book' => 1,
            ],
            [
                'id' => 2,
                'event_type' => 'Lorem ipsum Gog sit amet',
                'simple_booking' => 1,
                'date_of_birth' => 1,
                'medical' => 1,
                'parent_applications' => 1,
                'invoice_text_id' => 4,
                'legal_text_id' => 3,
                'application_ref_id' => 6,
                'display_availability' => 1,
                'permit_holder' => 1,
                'team_leader' => 1,
                'sync_book' => 1,
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
