<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\InvoiceItemsTable Test Case
 */
class InvoiceItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceItemsTable
     */
    public $InvoiceItems;

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
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
        'app.invoices_payments',
        'app.itemtypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceItems') ? [] : ['className' => 'App\Model\Table\InvoiceItemsTable'];
        $this->InvoiceItems = TableRegistry::get('InvoiceItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceItems);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->InvoiceItems->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'district' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
            ],
            [
                'id' => 3,
                'district' => 'Lorem ipsum sit amet',
                'county' => 'Lorem dolor sit amet',
                'deleted' => null,
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
