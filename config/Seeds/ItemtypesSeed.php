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
                'itemtype' => 'Deposit',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '2',
                'itemtype' => 'Cubs',
                'roletype' => '1',
                'minor' => '1',
                'cancelled' => '0',
            ],
            [
                'id' => '3',
                'itemtype' => 'YLs',
                'roletype' => '8',
                'minor' => '1',
                'cancelled' => '0',
            ],
            [
                'id' => '4',
                'itemtype' => 'Leaders',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '5',
                'itemtype' => 'Discount',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '6',
                'itemtype' => 'Applied DIscount',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
            [
                'id' => '7',
                'itemtype' => 'Cancelled_Deposit',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '8',
                'itemtype' => 'Cancelled_Cubs',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '9',
                'itemtype' => 'Cancelled_Yls',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '10',
                'itemtype' => 'Cancelled_Leaders',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '1',
            ],
            [
                'id' => '11',
                'itemtype' => 'Late Payment Surcharge',
                'roletype' => NULL,
                'minor' => '0',
                'cancelled' => '0',
            ],
        ];

        $table = $this->table('itemtypes');
        $table->insert($data)->save();
    }
}
