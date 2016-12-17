<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScoutgroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\ScoutgroupsTable Test Case
 */
class ScoutgroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ScoutgroupsTable
     */
    public $Scoutgroups;

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.applications',
        'app.events',
        'app.settings',
        'app.settingtypes',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.invoices',
        'app.invoice_items',
        'app.itemtypes',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.notifications',
        'app.notificationtypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Scoutgroups') ? [] : ['className' => 'App\Model\Table\ScoutgroupsTable'];
        $this->Scoutgroups = TableRegistry::get('Scoutgroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scoutgroups);

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
