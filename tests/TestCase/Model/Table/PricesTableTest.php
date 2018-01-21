<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PricesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PricesTable Test Case
 */
class PricesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PricesTable
     */
    public $Prices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.password_states',
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
        $config = TableRegistry::exists('Prices') ? [] : ['className' => 'App\Model\Table\PricesTable'];
        $this->Prices = TableRegistry::get('Prices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prices);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Prices->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'item_type_id' => 1,
                'event_id' => 1,
                'max_number' => 1,
                'value' => 20.0,
                'description' => 'Team Booking Price'
            ],
            [
                'id' => 2,
                'item_type_id' => 2,
                'event_id' => 3,
                'max_number' => 5,
                'value' => 25.0,
                'description' => 'Cub Price'
            ],
            [
                'id' => 3,
                'item_type_id' => 3,
                'event_id' => 3,
                'max_number' => 2,
                'value' => 30.0,
                'description' => 'Beaver Price'
            ],
            [
                'id' => 4,
                'item_type_id' => 4,
                'event_id' => 3,
                'max_number' => 3,
                'value' => 35.0,
                'description' => 'Scout Price'
            ],
            [
                'id' => 5,
                'item_type_id' => 1,
                'event_id' => 1,
                'max_number' => 1,
                'value' => 100.0,
                'description' => 'Second Team Price'
            ],
            [
                'id' => 6,
                'item_type_id' => 5,
                'event_id' => 3,
                'max_number' => 3,
                'value' => 10.0,
                'description' => 'Explorer Price'
            ],
            [
                'id' => 7,
                'item_type_id' => 6,
                'event_id' => 3,
                'max_number' => 10,
                'value' => 15.0,
                'description' => 'Adult Price'
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
