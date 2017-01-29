<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceItemsTable Test Case
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
     */
    public $fixtures = [
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.events',
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
        'app.item_types',
        'app.prices',
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
                'id' => 3,
                'invoice_id' => 1,
                'value' => 1,
                'description' => 'Lorem ipsum dolor sit amet',
                'quantity' => 1,
                'item_type_id' => 1,
                'visible' => 1
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
