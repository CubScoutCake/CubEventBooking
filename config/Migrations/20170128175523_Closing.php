<?php

use Migrations\AbstractMigration;

class Closing extends AbstractMigration
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
        $table = $this->table('events');

        $table->addColumn('closing_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();

        $table = $this->table('applications');

        $table->renameColumn('permitholder', 'permit_holder')
            ->addColumn('team_leader', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->update();

        $table = $this->table('event_types');

        $table->addColumn('team_leader', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('permit_holder', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();

        $table = $this->table('districts');

        $table->addColumn('short_name', 'string', [
                'default' => null,
                'limit' => 16,
                'null' => true,
            ])
            ->update();

        $table = $this->table('roles');

        $table->addColumn('short_role', 'string', [
                'default' => null,
                'limit' => 16,
                'null' => true,
            ])
            ->update();
    }
}
