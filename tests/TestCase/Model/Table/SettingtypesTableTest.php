<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\SettingtypesTable Test Case
 */
class SettingtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SettingtypesTable
     */
    public $Settingtypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.settingtypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Settingtypes') ? [] : ['className' => 'App\Model\Table\SettingtypesTable'];
        $this->Settingtypes = TableRegistry::get('Settingtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Settingtypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Settingtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'settingtype' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet'
            ]
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
            'id' => null,
            'settingtype' => null,
            'description' => null
        ];

        $goodData = [
            'id' => 2,
            'settingtype' => 'Lorem Fish dolor sit amet',
            'description' => 'Lorem Monkey dolor sit amet'
        ];

        $expected = [
            [
                'id' => 1,
                'settingtype' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'id' => 2,
                'settingtype' => 'Lorem Fish dolor sit amet',
                'description' => 'Lorem Monkey dolor sit amet'
            ]
        ];

        $badEntity = $this->Settingtypes->newEntity($badData);
        //$inaccessibleEntity = $this->Settingtypes->newEntity($goodData);
        $goodEntity = $this->Settingtypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Settingtypes->save($badEntity));
        //$this->assertFalse($this->Settingtypes->save($inaccessibleEntity));
        $this->Settingtypes->save($goodEntity);

        $query = $this->Settingtypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
