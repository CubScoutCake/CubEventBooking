<?php
use Migrations\AbstractMigration;

class DepositsHoldBookings extends AbstractMigration
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
            ->table('item_types')
            ->addColumn('deposit', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->update();

        $this
            ->table('applications')
            ->addColumn('hold_numbers', 'json', [
                'null' => true,
            ])
            ->update();

        $this
            ->table('event_types')
            ->addColumn('hold_booking', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('attendee_booking', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('district_booking', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();
    }
}
