<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AuthRolesFixture
 *
 */
class AuthRolesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'auth_role' => ['type' => 'string', 'length' => 255, 'default' => 'user', 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'admin_access' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'champion_access' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'super_user' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'auth' => ['type' => 'integer', 'length' => 10, 'default' => '1', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'parent_access' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'user_access' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'section_limited' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'auth_roles_auth_role' => ['type' => 'unique', 'columns' => ['auth_role'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'auth_role' => 'User',
            'admin_access' => 0,
            'champion_access' => 0,
            'super_user' => 0,
            'auth' => 1,
            'parent_access' => 0,
            'user_access' => 1,
            'section_limited' => 1
        ],
        [
            'id' => 2,
            'auth_role' => 'SuperUser',
            'admin_access' => 1,
            'champion_access' => 1,
            'super_user' => 1,
            'auth' => 12,
            'parent_access' => 0,
            'user_access' => 1,
            'section_limited' => 0
        ],
    ];
}
