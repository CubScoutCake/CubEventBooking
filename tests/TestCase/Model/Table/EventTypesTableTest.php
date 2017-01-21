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
}
