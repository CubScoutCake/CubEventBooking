<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemTypesTable Test Case
 */
class ItemTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemTypesTable
     */
    public $ItemTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.password_states',
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
        $config = TableRegistry::exists('ItemTypes') ? [] : ['className' => 'App\Model\Table\ItemTypesTable'];
        $this->ItemTypes = TableRegistry::get('ItemTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->ItemTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'item_type' => 'Team Booking',
                'role_id' => null,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => true,
            ],
            [
                'id' => 2,
                'item_type' => 'Cub Item Type',
                'role_id' => 3,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 3,
                'item_type' => 'Beaver Item Type',
                'role_id' => 2,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 4,
                'item_type' => 'Scout Item Type',
                'role_id' => 4,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 5,
                'item_type' => 'YL Item Type',
                'role_id' => 5,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 6,
                'item_type' => 'Adult Item Type',
                'role_id' => 1,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
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
        $badData = [
            'itemtype' => null,
            'roletype' => null,
            'minor' => null,
            'available' => null,
            'team_price' => null,
        ];

        $goodData = [
            'minor' => true,
            'item_type' => 'Lorem dolor goat amet',
            'role_id' => 1,
            'cancelled' => false,
            'available' => true,
            'team_price' => false,
        ];

        $expected = [
            [
                'id' => 1,
                'item_type' => 'Team Booking',
                'role_id' => null,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => true,
            ],
            [
                'id' => 2,
                'item_type' => 'Cub Item Type',
                'role_id' => 3,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 3,
                'item_type' => 'Beaver Item Type',
                'role_id' => 2,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 4,
                'item_type' => 'Scout Item Type',
                'role_id' => 4,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 5,
                'item_type' => 'YL Item Type',
                'role_id' => 5,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 6,
                'item_type' => 'Adult Item Type',
                'role_id' => 1,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
            [
                'id' => 7,
                'minor' => true,
                'item_type' => 'Lorem dolor goat amet',
                'role_id' => 1,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
            ],
        ];

        $badEntity = $this->ItemTypes->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->ItemTypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->ItemTypes->save($badEntity));
        $this->ItemTypes->save($goodEntity);

        $query = $this->ItemTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
