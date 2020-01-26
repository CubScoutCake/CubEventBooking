<?php

use Migrations\AbstractMigration;

class Status extends AbstractMigration
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
        $table = $this->table('application_statuses');

        $table
            ->addColumn('application_status', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->addColumn('active', 'boolean')
            ->save();

        $table
            ->insert(['application_status' => 'Active', 'active' => true])
            ->save();

        $table = $this->table('applications');

        $table
            ->addColumn('application_status_id', 'integer', [
                'default' => 1,
                'null' => false,
            ])
            ->addForeignKey(
                'application_status_id',
                'application_statuses',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                ]
            )
            ->addIndex('application_status_id')
            ->save();

        $table = $this->table('event_statuses');

        $table
            ->addColumn('event_status', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->addColumn('live', 'boolean')
            ->addColumn('accepting_applications', 'boolean')
            ->save();

        $table
            ->insert(['event_status' => 'live', 'live' => true, 'accepting_applications' => true])
            ->save();

        $table = $this->table('events');

        $table
            ->addColumn('event_status_id', 'integer', [
                'default' => 1,
                'null' => false,
            ])
            ->addForeignKey(
                'event_status_id',
                'event_statuses',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                ]
            )
            ->addIndex('event_status_id')
            ->save();
    }
}
