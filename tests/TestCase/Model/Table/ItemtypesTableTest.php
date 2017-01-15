<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use phpDocumentor\Reflection\Types\Null_;

/**
 * App\ModelLevel\Table\ItemtypesTable Test Case
 */
class ItemtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemtypesTable
     */
    public $ItemTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_types'
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
        $this->Itemtypes = TableRegistry::get('ItemTypes', $config);
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
        $query = $this->Itemtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'minor' => true,
                'item_type' => 'Lorem ipsum dolor sit amet',
                'role_id' => 1,
                'cancelled' => true,
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
            'id' => 2,
            'itemtype' => null,
            'roletype' => null,
            'minor' => null
        ];

        $goodData = [
            'id' => 2,
            'minor' => true,
            'item_type' => 'Lorem dolor goat amet',
            'role_id' => 1,
            'cancelled' => false,
        ];

        $expected = [
            [
                'id' => 1,
                'minor' => true,
                'item_type' => 'Lorem ipsum dolor sit amet',
                'role_id' => 1,
                'cancelled' => true,
            ],
            [
                'id' => 2,
                'minor' => true,
                'item_type' => 'Lorem dolor goat amet',
                'role_id' => 1,
                'cancelled' => false,
            ],
        ];

        $badEntity = $this->Itemtypes->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Itemtypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Itemtypes->save($badEntity));
        $this->Itemtypes->save($goodEntity);

        $query = $this->Itemtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
