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
                'id' => 1,
                'auth_role' => 'User',
                'admin_access' => 0,
                'champion_access' => 0,
                'super_user' => 0,
                'auth' => 1,
            ],
            [
                'id' => 2,
                'auth_role' => 'Admin',
                'admin_access' => 1,
                'champion_access' => 1,
                'super_user' => 1,
                'auth' => 150,
            ],
        ];

        $table = $this->table('auth_roles');
        $table->insert($data)->save();
    }
}
