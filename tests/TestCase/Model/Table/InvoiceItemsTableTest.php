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
        'app.password_states',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.application_statuses',
        'app.events',
        'app.event_statuses',
        'app.event_types',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.item_types',
        'app.prices',
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
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'invoice_id' => 1,
                'value' => 10,
                'description' => 'CUBS',
                'quantity' => 5,
                'item_type_id' => 2,
                'visible' => true,
            ],
            [
                'id' => 2,
                'invoice_id' => 1,
                'value' => 0,
                'description' => 'YOUNG LEADERS',
                'quantity' => 4,
                'item_type_id' => 5,
                'visible' => 1
            ],
            [
                'id' => 3,
                'invoice_id' => 1,
                'value' => 5,
                'description' => 'LEADERS',
                'quantity' => 1,
                'item_type_id' => 6,
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
