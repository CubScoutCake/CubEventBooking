<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogisticsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogisticsTable Test Case
 */
class LogisticsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogisticsTable
     */
    public $Logistics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.applications',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.notes',
        'app.invoices',
        'app.invoice_items',
        'app.itemtypes',
        'app.payments',
        'app.invoices_payments',
        'app.notifications',
        'app.notificationtypes',
        'app.events',
        'app.settings',
        'app.settingtypes',
        'app.discounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Logistics') ? [] : ['className' => 'App\Model\Table\LogisticsTable'];
        $this->Logistics = TableRegistry::get('Logistics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logistics);

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
