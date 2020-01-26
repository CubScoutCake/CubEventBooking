<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

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
        'app.sessions',
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
        'app.notification_types',
        'app.notifications',
        'app.application_statuses',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.event_statuses',
        'app.discounts',
        'app.events',
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
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'item_type_id' => 1,
                'event_id' => 2,
                'max_number' => 6,
                'value' => 20.0,
                'description' => 'Team Booking Price',
            ],
            [
                'id' => 2,
                'item_type_id' => 2,
                'event_id' => 3,
                'max_number' => 5,
                'value' => 25.0,
                'description' => 'Cub Price',
            ],
            [
                'id' => 3,
                'item_type_id' => 3,
                'event_id' => 3,
                'max_number' => 2,
                'value' => 30.0,
                'description' => 'Beaver Price',
            ],
            [
                'id' => 4,
                'item_type_id' => 4,
                'event_id' => 3,
                'max_number' => 3,
                'value' => 35.0,
                'description' => 'Scout Price',
            ],
            [
                'id' => 5,
                'item_type_id' => 5,
                'event_id' => 3,
                'max_number' => 3,
                'value' => 10.0,
                'description' => 'Explorer Price',
            ],
            [
                'id' => 6,
                'item_type_id' => 6,
                'event_id' => 3,
                'max_number' => 10,
                'value' => 15.0,
                'description' => 'Adult Price',
            ],
            [
                'id' => 7,
                'item_type_id' => 7,
                'event_id' => 3,
                'max_number' => 0,
                'value' => 20,
                'description' => 'Team Deposit Price',
            ],
            [
                'id' => 8,
                'item_type_id' => 8,
                'event_id' => 3,
                'max_number' => 20,
                'value' => 10,
                'description' => 'Section Deposit Price',
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
