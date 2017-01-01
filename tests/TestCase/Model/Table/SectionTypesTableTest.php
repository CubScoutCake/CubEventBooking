<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SectionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SectionTypesTable Test Case
 */
class SectionTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SectionTypesTable
     */
    public $SectionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.section_types',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SectionTypes') ? [] : ['className' => 'App\Model\Table\SectionTypesTable'];
        $this->SectionTypes = TableRegistry::get('SectionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SectionTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->SectionTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'section_type' => 'Lorem ips',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 1
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
            'id' => 3,
            'section_type' => null,
            'upper_age' => null,
            'lower_age' => 'This is',
            'role_id' => null
        ];

        $goodData = [
            'id' => 2,
            'section_type' => 'aksfka ips',
            'upper_age' => 14,
            'lower_age' => 10,
            'role_id' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'section_type' => 'Lorem ips',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 1
            ],
            [
                'id' => 2,
                'section_type' => 'aksfka ips',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 1
            ]
        ];

        $badEntity = $this->SectionTypes->newEntity($badData);
        $goodEntity = $this->SectionTypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->SectionTypes->save($badEntity));
        $this->SectionTypes->save($goodEntity);

        $query = $this->SectionTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $badData = [
            'id' => 4,
            'section_type' => 'aksfasfa',
            'upper_age' => 99,
            'lower_age' => 2451,
            'role_id' => 288
        ];

        $goodData = [
            'id' => 4,
            'section_type' => 'Octopus',
            'upper_age' => 8,
            'lower_age' => 6,
            'role_id' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'section_type' => 'Lorem ips',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 1
            ],
            [
                'id' => 4,
                'section_type' => 'Octopus',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 1
            ]
        ];

        $badEntity = $this->SectionTypes->newEntity($badData);
        $goodEntity = $this->SectionTypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->SectionTypes->save($badEntity));
        $this->SectionTypes->save($goodEntity);

        $query = $this->SectionTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
