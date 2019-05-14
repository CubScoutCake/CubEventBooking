<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AllergiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AllergiesTable Test Case
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
        'app.Allergies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Allergies') ? [] : ['className' => AllergiesTable::class];
        $this->Allergies = TableRegistry::getTableLocator()->get('Allergies', $config);
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
     * Get Good Set Function
     *
     * @return array
     *
     * @throws
     */
    private function getExpected()
    {
        return [
            [
                'id' => 1,
                'allergy' => 'Fish Allergy',
                'description' => 'Fish Allergies can kill cuttlefish',
                'is_medical' => false,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'id' => 2,
                'allergy' => 'Goats',
                'description' => 'Goat Allergy is very serious',
                'is_medical' => false,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'id' => 3,
                'allergy' => 'Diabetes',
                'description' => 'Crazy sugar thing',
                'is_medical' => true,
                'is_specific' => false,
                'is_dietary' => true
            ],
            [
                'id' => 4,
                'allergy' => 'Epilepsy',
                'description' => 'Serious Neural disorder',
                'is_medical' => false,
                'is_specific' => false,
                'is_dietary' => true
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
        $query = $this->Allergies->find('all');

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
            'allergy' => null,
            'description' => null
        ];

        $goodData = [
            'allergy' => 'Lorem Goat Fish dolor sit amet',
            'description' => 'Lorem Monkey dolor sit amet, aliquet feugiat. The Goat',
            'is_medical' => false,
            'is_dietary' => true,
            'is_specific' => false,
        ];

        $expected = $this->getExpected();
        $goodExpectation = array_merge($goodData, ['id' => 6]);
        array_push($expected, $goodExpectation);

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
