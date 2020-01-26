<?php

use Migrations\AbstractSeed;

/**
 * Itemtypes seed.
 */
class ItemtypesSeed extends AbstractSeed
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
                'item_type' => 'Deposit',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'item_type' => 'Cubs',
                'role_id' => '1',
                'minor' => '1',
                'cancelled' => '0',
            ],
            [
                'item_type' => 'YLs',
                'role_id' => '8',
                'minor' => '1',
                'cancelled' => '0',
            ],
            [
                'item_type' => 'Leaders',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'item_type' => 'Discount',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'item_type' => 'Applied Discount',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'item_type' => 'Cancelled_Deposit',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'item_type' => 'Cancelled_Cubs',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'item_type' => 'Cancelled_Yls',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'item_type' => 'Cancelled_Leaders',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'item_type' => 'Late Payment Surcharge',
                'role_id' => null,
                'minor' => '0',
                'cancelled' => '0',
            ],
        ];

        $table = $this->table('item_types');
        $table->insert($data)->save();
    }
}
