<?php
use Migrations\AbstractMigration;

class CounterReservations extends AbstractMigration
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
            ->addColumn('cc_complete_reservations', 'integer', [
                'null' => true,
            ])
            ->update();

        $this
            ->table('reservations')
            ->addColumn('cancelled', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();

        $this
            ->table('reservation_statuses')
            ->addColumn('cancelled', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('status_order', 'integer', [
                'null' => false,
                'default' => 0,
            ])
            ->update();
    }
}
