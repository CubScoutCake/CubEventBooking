<?php
use Migrations\AbstractSeed;

/**
 * AuthRoles seed.
 */
class AuthRolesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 2,
                'auth_role' => 'Admin',
                'admin_access' => 1,
                'champion_access' => 1,
                'super_user' => 0,
                'user_access' => 1,
                'parent_access' => 0,
                'auth' => 150,
                'section_limited' => 1,
            ],
            [
                'id' => 3,
                'auth_role' => 'SuperUser',
                'admin_access' => 1,
                'champion_access' => 1,
                'super_user' => 1,
                'user_access' => 1,
                'parent_access' => 0,
                'auth' => 150,
                'section_limited' => 0,
            ],
        ];

        $table = $this->table('auth_roles');
        $table->insert($data)->save();
    }
}
