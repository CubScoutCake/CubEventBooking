<?php

use Migrations\AbstractMigration;

class PaymentScheduleType extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this
            ->table('invoice_items')
            ->addColumn('schedule_line', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();

        $this
            ->table('events')
            ->addColumn('deposit_is_schedule', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();
    }
}
