<?php

use Migrations\AbstractMigration;

class AppStatusBool extends AbstractMigration
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
            ->table('application_statuses')
            ->addColumn('no_money', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('reserved', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('attendees_added', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();
    }
}
