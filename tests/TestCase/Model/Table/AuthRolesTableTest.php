<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuthRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\AuthRolesTable Test Case
 */
class AuthRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AuthRolesTable
     */
    public $AuthRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.auth_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AuthRoles') ? [] : ['className' => 'App\Model\Table\AuthRolesTable'];
        $this->AuthRoles = TableRegistry::get('AuthRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AuthRoles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->AuthRoles->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'auth_role' => 'User',
                'admin_access' => false,
                'champion_access' => false,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => true,
            ],
            [
                'id' => 2,
                'auth_role' => 'SuperUser',
                'admin_access' => true,
                'champion_access' => true,
                'super_user' => true,
                'auth' => 12,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => false,
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
            'auth_role' => null,
            'admin_access' => true,
            'champion_access' => true,
            'super_user' => false,
            'auth' => null,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true,
        ];

        $goodData = [
            'id' => 3,
            'auth_role' => 'Admin',
            'admin_access' => true,
            'champion_access' => true,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true,
        ];

        $expected = [
            [
                'id' => 1,
                'auth_role' => 'User',
                'admin_access' => false,
                'champion_access' => false,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => true,
            ],
            [
                'id' => 2,
                'auth_role' => 'SuperUser',
                'admin_access' => true,
                'champion_access' => true,
                'super_user' => true,
                'auth' => 12,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => false,
            ],
            [
                'id' => 3,
                'auth_role' => 'Admin',
                'admin_access' => true,
                'champion_access' => true,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => true,
            ],
        ];

        $badEntity = $this->AuthRoles->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->AuthRoles->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->AuthRoles->save($badEntity));
        $this->AuthRoles->save($goodEntity);

        $query = $this->AuthRoles->find('all');

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
            'id' => 1,
            'auth_role' => 'User',
            'admin_access' => false,
            'champion_access' => false,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true,
        ];

        $goodData = [
            'id' => 3,
            'auth_role' => 'Admin',
            'admin_access' => true,
            'champion_access' => true,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true,
        ];

        $expected = [
            [
                'id' => 1,
                'auth_role' => 'User',
                'admin_access' => false,
                'champion_access' => false,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => true,
            ],
            [
                'id' => 2,
                'auth_role' => 'SuperUser',
                'admin_access' => true,
                'champion_access' => true,
                'super_user' => true,
                'auth' => 12,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => false,
            ],
            [
                'id' => 3,
                'auth_role' => 'Admin',
                'admin_access' => true,
                'champion_access' => true,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => true,
            ],
        ];

        $badEntity = $this->AuthRoles->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->AuthRoles->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->AuthRoles->save($badEntity));
        $this->AuthRoles->save($goodEntity);

        $query = $this->AuthRoles->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
