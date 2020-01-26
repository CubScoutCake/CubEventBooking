<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

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
        'app.sessions',
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
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
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'section_type' => 'Beavers',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 2,
            ],
            [
                'id' => 2,
                'section_type' => 'Cubs',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 3,
            ],
            [
                'id' => 3,
                'section_type' => 'Scouts',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 4,
            ],
            [
                'id' => 4,
                'section_type' => 'Explorers',
                'upper_age' => 18,
                'lower_age' => 14,
                'role_id' => 5,
            ],
            [
                'id' => 5,
                'section_type' => 'Adults',
                'upper_age' => 99,
                'lower_age' => 18,
                'role_id' => 1,
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
            'section_type' => null,
            'upper_age' => null,
            'lower_age' => 'This is',
            'role_id' => null,
        ];

        $goodData = [
            'section_type' => 'aksfka ips',
            'upper_age' => 14,
            'lower_age' => 10,
            'role_id' => 1,
        ];

        $expected = [
            [
                'id' => 1,
                'section_type' => 'Beavers',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 2,
            ],
            [
                'id' => 2,
                'section_type' => 'Cubs',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 3,
            ],
            [
                'id' => 3,
                'section_type' => 'Scouts',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 4,
            ],
            [
                'id' => 4,
                'section_type' => 'Explorers',
                'upper_age' => 18,
                'lower_age' => 14,
                'role_id' => 5,
            ],
            [
                'id' => 5,
                'section_type' => 'Adults',
                'upper_age' => 99,
                'lower_age' => 18,
                'role_id' => 1,
            ],
            [
                'id' => 6,
                'section_type' => 'aksfka ips',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 1,
            ],
        ];

        $badEntity = $this->SectionTypes->newEntity($badData);
        $goodEntity = $this->SectionTypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->SectionTypes->save($badEntity));
        $this->SectionTypes->save($goodEntity);

        $query = $this->SectionTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

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
            'section_type' => 'aksfasfa',
            'upper_age' => 99,
            'lower_age' => 2451,
            'role_id' => 288,
        ];

        $goodData = [
            'section_type' => 'Octopus',
            'upper_age' => 8,
            'lower_age' => 6,
            'role_id' => 1,
        ];

        $expected = [
            [
                'id' => 1,
                'section_type' => 'Beavers',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 2,
            ],
            [
                'id' => 2,
                'section_type' => 'Cubs',
                'upper_age' => 10,
                'lower_age' => 8,
                'role_id' => 3,
            ],
            [
                'id' => 3,
                'section_type' => 'Scouts',
                'upper_age' => 14,
                'lower_age' => 10,
                'role_id' => 4,
            ],
            [
                'id' => 4,
                'section_type' => 'Explorers',
                'upper_age' => 18,
                'lower_age' => 14,
                'role_id' => 5,
            ],
            [
                'id' => 5,
                'section_type' => 'Adults',
                'upper_age' => 99,
                'lower_age' => 18,
                'role_id' => 1,
            ],
            [
                'id' => 6,
                'section_type' => 'Octopus',
                'upper_age' => 8,
                'lower_age' => 6,
                'role_id' => 1,
            ],
        ];

        $badEntity = $this->SectionTypes->newEntity($badData);
        $goodEntity = $this->SectionTypes->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->SectionTypes->save($badEntity));
        $this->SectionTypes->save($goodEntity);

        $query = $this->SectionTypes->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
