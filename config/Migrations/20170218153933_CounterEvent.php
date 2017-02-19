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
                'null' => true
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
                'default' => null,
                'null' => true,
            ])
            ->addForeignKey(
                'application_ref_id',
                'settings',
                'id'
                )
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
            ->save();

        $table = $this->table('applications');
        $table->changeColumn('eventname', 'string', [
                'default' => null,
                'null' => true,
                'length' => 255,
            ])
            ->save();

        parent::up();
    }
}
