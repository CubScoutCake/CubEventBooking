<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllergiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\AllergiesTable Test Case
 */
class AllergiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AllergiesTable
     */
    public $Allergies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allergies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Allergies') ? [] : ['className' => 'App\Model\Table\AllergiesTable'];
        $this->Allergies = TableRegistry::get('Allergies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Allergies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Allergies->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'allergy' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. The Goat'
            ],
            [
                'id' => 2,
                'allergy' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. The Goat'
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
            'allergy' => null,
            'description' => null
        ];

        $goodData = [
            'id' => 3,
            'allergy' => 'Lorem Goat Fish dolor sit amet',
            'description' => 'Lorem Monkey dolor sit amet, aliquet feugiat. The Goat'
        ];

        $expected = [
            [
                'id' => 1,
                'allergy' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. The Goat'
            ],
            [
                'id' => 2,
                'allergy' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. The Goat'
            ],
            [
                'id' => 3,
                'allergy' => 'Lorem Goat Fish dolor sit amet',
                'description' => 'Lorem Monkey dolor sit amet, aliquet feugiat. The Goat'
            ]
        ];

        $badEntity = $this->Allergies->newEntity($badData);
        $goodEntity = $this->Allergies->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Allergies->save($badEntity));
        $this->Allergies->save($goodEntity);

        $query = $this->Allergies->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
