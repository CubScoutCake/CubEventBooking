<?php
use Migrations\AbstractMigration;

class EventStatusesFull extends AbstractMigration
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
            ->table('event_statuses')
            ->addColumn('spaces_full', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->addColumn('pending_date', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->addColumn('status_order', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->addIndex('event_status', [
                'unique' => true,
            ])
            ->update();
    }
}
