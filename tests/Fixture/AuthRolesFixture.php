<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AuthRolesFixture
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
     * Init method
     *
     * @return void
     */
    public $records = [
        [
            'auth_role' => 'User',
            'admin_access' => false,
            'champion_access' => false,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true
        ],
        [
            'auth_role' => 'SuperUser',
            'admin_access' => true,
            'champion_access' => true,
            'super_user' => true,
            'auth' => 12,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => false
        ],
        [
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
