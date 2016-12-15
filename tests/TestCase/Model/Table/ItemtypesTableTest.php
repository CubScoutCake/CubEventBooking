<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemtypesTable Test Case
 */
class ItemtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemtypesTable
     */
    public $Itemtypes;

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
        'app.itemtypes',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
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
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.notifications',
        'app.notificationtypes',
        'app.payments',
        'app.invoices_payments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Itemtypes') ? [] : ['className' => 'App\Model\Table\ItemtypesTable'];
        $this->Itemtypes = TableRegistry::get('Itemtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itemtypes);

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
