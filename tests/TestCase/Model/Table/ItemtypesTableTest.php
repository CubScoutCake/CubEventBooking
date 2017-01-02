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
    public $Itemtypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $query = $this->Itemtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'itemtype' => 'Lorem ipsum dolor sit amet',
                'roletype' => 1,
                'minor' => 1
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
            'itemtype' => 'Lorem dolor goat amet',
            'roletype' => 0,
            'minor' => 0
        ];

        $expected = [
            [
                'id' => 1,
                'itemtype' => 'Lorem ipsum dolor sit amet',
                'roletype' => 1,
                'minor' => 1
            ],
            [
                'id' => 2,
                'itemtype' => 'Lorem dolor goat amet',
                'roletype' => 0,
                'minor' => 0
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
