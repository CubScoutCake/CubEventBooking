<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DistrictsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DistrictsTable Test Case
 */
class DistrictsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DistrictsTable
     */
    public $Districts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Districts',
        'app.Scoutgroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Districts') ? [] : ['className' => DistrictsTable::class];
        $this->Districts = TableRegistry::getTableLocator()->get('Districts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Districts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Districts->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'district' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ],
            [
                'id' => 3,
                'district' => 'Lorem ipsum sit amet',
                'county' => 'Lorem dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
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
            'district' => null,
            'county' => null,
            'deleted' => null,
            'short_name' => null,
        ];

        $goodData = [
            'id' => 4,
            'district' => 'Lorem fish dolor sit amet',
            'county' => 'Lorem ipsum fish dolor amet',
            'short_name' => 'Lorem',
        ];

        $expected = [
            [
                'id' => 1,
                'district' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ],
            [
                'id' => 3,
                'district' => 'Lorem ipsum sit amet',
                'county' => 'Lorem dolor sit amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ],
            [
                'id' => 4,
                'district' => 'Lorem fish dolor sit amet',
                'county' => 'Lorem ipsum fish dolor amet',
                'deleted' => null,
                'short_name' => 'Lorem',
            ]
        ];

        $badEntity = $this->Districts->newEntity($badData);
        $goodEntity = $this->Districts->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Districts->save($badEntity));
        $this->Districts->save($goodEntity);

        $query = $this->Districts->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
