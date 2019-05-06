<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\ItemType;
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
        'app.ItemTypes',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemTypes') ? [] : ['className' => ItemTypesTable::class];
        $this->ItemTypes = TableRegistry::getTableLocator()->get('ItemTypes', $config);
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
     * @return array
     */
    private function getExpected()
    {
        return [
            [
                'id' => 1,
                'item_type' => 'Team Booking',
                'role_id' => null,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => true,
                'deposit' => false,
            ],
            [
                'id' => 2,
                'item_type' => 'Cub Item Type',
                'role_id' => 3,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
                'deposit' => false,
            ],
            [
                'id' => 3,
                'item_type' => 'Beaver Item Type',
                'role_id' => 2,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
                'deposit' => false,
            ],
            [
                'id' => 4,
                'item_type' => 'Scout Item Type',
                'role_id' => 4,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
                'deposit' => false,
            ],
            [
                'id' => 5,
                'item_type' => 'YL Item Type',
                'role_id' => 5,
                'minor' => true,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
                'deposit' => false,
            ],
            [
                'id' => 6,
                'item_type' => 'Adult Item Type',
                'role_id' => 1,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
                'deposit' => false,
            ],
            [
                'id' => 7,
                'item_type' => 'Team Deposit',
                'role_id' => 1,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => true,
                'deposit' => true,
            ],
            [
                'id' => 8,
                'item_type' => 'Section Deposit',
                'role_id' => 1,
                'minor' => false,
                'cancelled' => false,
                'available' => true,
                'team_price' => false,
                'deposit' => true,
            ],
        ];
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
        $expected = $this->getExpected();

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
            'deposit' => null,
        ];

        $goodData = [
            'minor' => true,
            'item_type' => 'Lorem dolor goat amet',
            'role_id' => 1,
            'cancelled' => false,
            'available' => true,
            'team_price' => false,
            'deposit' => false,
        ];

        $badEntity = $this->ItemTypes->newEntity($badData);
        $goodEntity = $this->ItemTypes->newEntity($goodData);

        $this->assertFalse($this->ItemTypes->save($badEntity));
        $this->assertInstanceOf(ItemType::class, $this->ItemTypes->save($goodEntity));

        $query = $this->ItemTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $expected = $this->getExpected();
        $goodData['id'] = 9;
        array_push($expected, $goodData);

        $this->assertEquals($expected, $result);
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
