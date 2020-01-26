<?php

use Migrations\AbstractMigration;

class AddTimeZoneSupport extends AbstractMigration
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
            ->table('events')
            ->changeColumn('start_date', 'timestamp', [
                'timezone' => true,
                'null' => false,
            ])
            ->changeColumn('end_date', 'timestamp', [
                'timezone' => true,
                'null' => false,
            ])
            ->changeColumn('created', 'timestamp', [
                'timezone' => true,
                'null' => true,
            ])
            ->changeColumn('modified', 'timestamp', [
                'timezone' => true,
                'null' => true,
            ])
            ->changeColumn('deleted', 'timestamp', [
                'timezone' => true,
                'null' => true,
            ])
            ->changeColumn('closing_date', 'timestamp', [
                'timezone' => true,
                'null' => true,
            ])
            ->changeColumn('opening_date', 'timestamp', [
                'timezone' => true,
                'null' => true,
            ])
            ->changeColumn('deposit_date', 'timestamp', [
                'timezone' => true,
                'null' => true,
            ])
            ->update();
    }
}
