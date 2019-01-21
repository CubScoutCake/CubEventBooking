<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogisticItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogisticItemsTable Test Case
 */
class LogisticItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogisticItemsTable
     */
    public $LogisticItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.logistic_items',
        'app.applications',
        'app.parameter_sets',
        'app.logistics',
        'app.params',
        'app.events',
        'app.event_statuses',
        'app.event_types',
        'app.settings',
        'app.password_states',
        'app.setting_types',
        'app.users',
        'app.roles',
        'app.discounts',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.application_statuses',
        'app.reservations',
        'app.champions',
        'app.reservation_statuses',
        'app.attendees',
        'app.parameters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LogisticItems') ? [] : ['className' => LogisticItemsTable::class];
        $this->LogisticItems = TableRegistry::getTableLocator()->get('LogisticItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LogisticItems);

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
