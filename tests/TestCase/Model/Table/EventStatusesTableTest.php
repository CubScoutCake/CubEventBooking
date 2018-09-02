<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventStatusesTable Test Case
 */
class EventStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventStatusesTable
     */
    public $EventStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.password_states',
        'app.setting_types',
        'app.discounts',
        'app.applications', 'app.application_statuses',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.invoices',
        'app.invoice_items',
        'app.item_types',
        'app.prices',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.notifications',
        'app.notification_types',
        'app.logistic_items',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
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
        $config = TableRegistry::getTableLocator()->exists('EventStatuses') ? [] : ['className' => EventStatusesTable::class];
        $this->EventStatuses = TableRegistry::getTableLocator()->get('EventStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventStatuses);

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
}
