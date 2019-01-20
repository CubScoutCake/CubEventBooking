<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTable;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsTable
     */
    public $Events;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Events') ? [] : ['className' => EventsTable::class];
        $this->Events = TableRegistry::getTableLocator()->get('Events', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Events);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
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

    /**
     * Test findUnarchived method
     *
     * @return void
     */
    public function testFindUnarchived()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUpcoming method
     *
     * @return void
     */
    public function testFindUpcoming()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testDetermineComplete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUpcoming method
     *
     * @return void
     */
    public function testGetPriceSection()
    {
        // Team Price Event
        $section = $this->Events->getPriceSection(2);
        $this->assertEquals(6, $section);

        // Individual Price Event
        $section = $this->Events->getPriceSection(3);
        $this->assertEquals(5, $section);
    }
}
