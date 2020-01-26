<?php

use Migrations\AbstractMigration;

class CounterEvent extends AbstractMigration
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
        $table->renameColumn('available_apps', 'max_apps')
            ->renameColumn('available_cubs', 'max_section')
            ->addColumn('cc_apps', 'integer', [
                'default' => 0,
                'null' => true,
            ])
            //->addColumn('cc_invs')
            ->addColumn('complete', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->update();

        $table = $this->table('attendees');
        $table->addColumn('cc_apps', 'integer', [
                'default' => 0,
                'null' => true,
            ])
            ->update();

        $table = $this->table('event_types');
        $table->addColumn('display_availability', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->addColumn('application_ref_id', 'integer', [
                'default' => 1,
                'null' => false,
            ])
            ->addForeignKey(
                'application_ref_id',
                'settings',
                'id'
            )
            ->addIndex('application_ref_id')
            ->update();
    }

    /**
     * Up Method
     */
    public function up()
    {
        $table = $this->table('events');
        $table->removeColumn('max_cubs')
            ->removeColumn('max_leaders')
            ->removeColumn('max_yls')
            ->removeColumn('cubs')
            ->removeColumn('cubs_value')
            ->removeColumn('cubs_text')
            ->removeColumn('yls')
            ->removeColumn('yls_value')
            ->removeColumn('yls_text')
            ->removeColumn('leaders')
            ->removeColumn('leaders_value')
            ->removeColumn('leaders_text')
            ->update();

        $table = $this->table('applications');
        $table->changeColumn('eventname', 'string', [
                'default' => null,
                'null' => true,
                'length' => 255,
            ])
            ->update();

        $table = $this->table('event_types');
        $table->changeColumn('team_leader', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->changeColumn('permit_holder', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->changeColumn('parent_applications', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->changeColumn('dietary', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->changeColumn('medical', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->changeColumn('simple_booking', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->changeColumn('date_of_birth', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->update();

        parent::up();
    }
}
