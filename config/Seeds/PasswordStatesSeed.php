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
                'id' => '1',
                'password_state' => 'Active',
                'active' => '1',
                'expired' => '0',
            ],
            [
                'id' => '2',
                'password_state' => 'Awaiting Reset',
                'active' => '1',
                'expired' => '0',
            ],
            [
                'id' => '3',
                'password_state' => 'Expired',
                'active' => '0',
                'expired' => '1',
            ],
        ];

        $table = $this->table('password_states');
        $table->insert($data)->save();
    }
}
