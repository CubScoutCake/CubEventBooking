<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\RolesTable Test Case
 */
class RolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RolesTable
     */
    public $Roles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Roles') ? [] : ['className' => 'App\Model\Table\RolesTable'];
        $this->Roles = TableRegistry::get('Roles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Roles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Roles->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'invested' => 1,
                'minor' => 1,
                'automated' => 1,
                'deleted' => null
            ],
            [
                'id' => 2,
                'role' => 'Lorem ipsum dasfasolor sit amet',
                'invested' => 0,
                'minor' => 0,
                'automated' => 0,
                'deleted' => null
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
            'id' => 5,
            'role' => null,
            'invested' => 1,
            'minor' => 0,
            'automated' => 0,
            'deleted' => null
        ];

        $goodData = [
            'id' => 5,
            'role' => 'Lorem Goat dasfasolor sit amet',
            'invested' => 1,
            'minor' => 0,
            'automated' => 0,
            'deleted' => null
        ];

        $expected = [
            [
                'id' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'invested' => 1,
                'minor' => 1,
                'automated' => 1,
                'deleted' => null
            ],
            [
                'id' => 2,
                'role' => 'Lorem ipsum dasfasolor sit amet',
                'invested' => 0,
                'minor' => 0,
                'automated' => 0,
                'deleted' => null
            ],
            [
                'id' => 5,
                'role' => 'Lorem Goat dasfasolor sit amet',
                'invested' => 1,
                'minor' => 0,
                'automated' => 0,
                'deleted' => null
            ],
        ];

        $badEntity = $this->Roles->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Roles->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Roles->save($badEntity));
        $this->Roles->save($goodEntity);

        $query = $this->Roles->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test findNonAuto method
     *
     * @return void
     */
    public function testFindNonAuto()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAdults method
     *
     * @return void
     */
    public function testFindAdults()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findLeaders method
     *
     * @return void
     */
    public function testFindLeaders()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findMinors method
     *
     * @return void
     */
    public function testFindMinors()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
