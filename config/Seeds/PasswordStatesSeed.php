<?php
use Migrations\AbstractSeed;

/**
 * PasswordStates seed.
 */
class PasswordStatesSeed extends AbstractSeed
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
                'password_state' => 'Active',
                'active' => true,
                'expired' => false,
            ],
            [
                'id' => 2,
                'password_state' => 'Awaiting Reset',
                'active' => true,
                'expired' => false,
            ],
            [
                'id' => 3,
                'password_state' => 'Expired',
                'active' => false,
                'expired' => true,
            ],
        ];

        $table = $this->table('password_states');
        $table->insert($data)->save();
    }
}
