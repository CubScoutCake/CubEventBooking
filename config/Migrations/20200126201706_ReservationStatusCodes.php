<?php

use Migrations\AbstractMigration;

class ReservationStatusCodes extends AbstractMigration
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
            ->table('reservation_statuses')
            ->addColumn('email_code', 'string', [
                'default' => null,
                'null' => true,
                'limit' => 3,
            ])
            ->update();

        $this
            ->table('application_statuses')
            ->addColumn('email_code', 'string', [
                'default' => null,
                'null' => true,
                'limit' => 3,
            ])
            ->update();
    }
}
