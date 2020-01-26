<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

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
        'app.AuthRoles',
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
     * Setup Expected
     *
     * @return array
     */
    private function getExpected()
    {
        return [
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
                'champion_access' => false,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => false,
                'user_access' => true,
                'section_limited' => true,
            ],
            [
                'id' => 4,
                'auth_role' => 'Parent',
                'admin_access' => false,
                'champion_access' => false,
                'super_user' => false,
                'auth' => 1,
                'parent_access' => true,
                'user_access' => false,
                'section_limited' => true,
            ],
            [
                'id' => 5,
                'auth_role' => 'Parent User',
                'admin_access' => false,
                'champion_access' => false,
                'super_user' => false,
                'auth' => 12,
                'parent_access' => true,
                'user_access' => true,
                'section_limited' => true,
            ],
        ];
    }

    /**
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        return [
            'auth_role' => 'New Admin ' . random_int(11111, 99999) . random_int(11111, 99999),
            'admin_access' => true,
            'champion_access' => true,
            'super_user' => false,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true,
        ];
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
        // Test Good
        $good = $this->getGood();
        $this->assertInstanceOf('App\Model\Entity\AuthRole', $this->AuthRoles->save($this->AuthRoles->newEntity($good)));

        $query = $this->AuthRoles->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $expected = $this->getExpected();
        array_push($expected, array_merge($good, ['id' => 6, 'auth' => 14]));

        $this->assertEquals($expected, $result);

        // Test Empty
        $empty = [
            'admin_access',
            'champion_access',
            'super_user',
            'parent_access',
            'user_access',
            'section_limited',
        ];

        foreach ($empty as $field) {
            $good = $this->getGood();
            $good[$field] = null;

            $this->assertInstanceOf('App\Model\Entity\AuthRole', $this->AuthRoles->save($this->AuthRoles->newEntity($good)));
        }

        // Test Not Empty
        $notEmpty = [
            'auth_role',
        ];

        foreach ($notEmpty as $field) {
            $good = $this->getGood();
            $good[$field] = null;

            $saved = $this->AuthRoles->save($this->AuthRoles->newEntity($good));
            $this->assertNotInstanceOf('App\Model\Entity\AuthRole', $saved);
            $this->assertFalse($saved);
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $badData = [
            'auth_role' => 'User',
            'admin_access' => false,
            'champion_access' => false,
            'super_user' => false,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true,
        ];
        $goodData = $this->getGood();

        $badEntity = $this->AuthRoles->newEntity($badData);
        $goodEntity = $this->AuthRoles->newEntity($goodData);

        $this->assertFalse($this->AuthRoles->save($badEntity));
        $this->assertInstanceOf('App\Model\Entity\AuthRole', $this->AuthRoles->save($goodEntity));

        $query = $this->AuthRoles->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $expected = $this->getExpected();
        array_push($expected, array_merge($goodData, ['id' => 6, 'auth' => 14]));

        $this->assertEquals($expected, $result);
    }

    /**
     * Test Before Save
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $good = $this->getGood();

        $new = $this->AuthRoles->newEntity($good);
        $new->set('auth', 150);

        $new = $this->AuthRoles->save($new);
        $this->assertInstanceOf('App\Model\Entity\AuthRole', $new);

        $this->assertNotEquals(150, $new->get('auth'));
        $this->assertEquals(14, $new->get('auth'));
    }

    /**
     * Test Before Save
     *
     * @return void
     */
    public function testParentAuthRole()
    {
        // Test Alter
        foreach ($this->AuthRoles->find('all') as $authRole) {
            /** @var \App\Model\Entity\AuthRole $authRole */
            $return = $this->AuthRoles->parentAuthRole($authRole);
            $this->assertTrue(is_numeric($return));

            $new = $this->AuthRoles->get($return);
            $this->assertTrue($new->parent_access);

            if (!$authRole->parent_access) {
                $this->assertNotEquals($authRole->id, $return);
                $this->assertNotEquals($authRole->auth_role, $new->auth_role);
                $this->assertEquals($authRole->auth_role . ' Parent', $new->auth_role);
            } else {
                $this->assertEquals($authRole->id, $return);
                $this->assertEquals($authRole->auth_role, $new->auth_role);
            }

            $secondReturn = $this->AuthRoles->parentAuthRole($new);
            $secondReturnAuth = $this->AuthRoles->get($secondReturn);
            $this->assertTrue($secondReturnAuth->parent_access);

            $this->assertEquals($return, $secondReturn);
            $this->assertEquals($new->auth_role, $secondReturnAuth->auth_role);
        }

        // Test Empty Parameter Returns
        $nullReturn = $this->AuthRoles->parentAuthRole();
        $this->assertTrue(is_numeric($nullReturn));
        $this->assertEquals(4, $nullReturn);

        // Test Create
        $matching = $this->AuthRoles->get(4);
        $matching->set('super_user', true);
        $matching->set('auth_role', 'NOT PARENT');
        $this->AuthRoles->save($matching);
        $this->assertEquals(17, $matching->auth_value);

        $nullReturn = $this->AuthRoles->parentAuthRole();
        $this->assertTrue(is_numeric($nullReturn));
        $this->assertEquals(9, $nullReturn);
    }
}
