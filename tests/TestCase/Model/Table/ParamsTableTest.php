<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParamsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\ParamsTable Test Case
 */
class ParamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParamsTable
     */
    public $Params;

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
        'app.params',
        'app.parameters',
        'app.parameter_sets',
        'app.logistics',
        'app.events',
        'app.settings',
        'app.settingtypes',
        'app.discounts',
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
        'app.logistic_items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Params') ? [] : ['className' => 'App\Model\Table\ParamsTable'];
        $this->Params = TableRegistry::get('Params', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Params);

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
