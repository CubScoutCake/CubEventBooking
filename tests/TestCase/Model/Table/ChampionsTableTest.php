<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChampionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChampionsTable Test Case
 */
class ChampionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChampionsTable
     */
    public $Champions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.champions',
        'app.districts',
        'app.scoutgroups',
        'app.applications',
        'app.users',
        'app.roles',
        'app.attendees',
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
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
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
        $config = TableRegistry::exists('Champions') ? [] : ['className' => 'App\Model\Table\ChampionsTable'];
        $this->Champions = TableRegistry::get('Champions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Champions);

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
