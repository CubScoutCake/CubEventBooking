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
                'id' => '1',
                'item_type' => 'Deposit',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '2',
                'item_type' => 'Cubs',
                'role_id' => '1',
                'minor' => '1',
                'cancelled' => '0',
            ],
            [
                'id' => '3',
                'item_type' => 'YLs',
                'role_id' => '8',
                'minor' => '1',
                'cancelled' => '0',
            ],
            [
                'id' => '4',
                'item_type' => 'Leaders',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '5',
                'item_type' => 'Discount',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '6',
                'item_type' => 'Applied Discount',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '7',
                'item_type' => 'Cancelled_Deposit',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '8',
                'item_type' => 'Cancelled_Cubs',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '9',
                'item_type' => 'Cancelled_Yls',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '10',
                'item_type' => 'Cancelled_Leaders',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '11',
                'item_type' => 'Late Payment Surcharge',
                'role_id' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
        ];

        $table = $this->table('item_types');
        $table->insert($data)->save();
    }
}
