<?php
use Migrations\AbstractMigration;

class PayableAndSectionValidation extends AbstractMigration
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
        $table = $this->table('sections');

        $table
            ->addColumn('validated', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->addColumn('cc_users', 'integer', [
                'default' => null,
                'null' => true,
                'limit' => 11,
            ])
            ->addColumn('cc_atts', 'integer', [
                'default' => null,
                'null' => true,
                'limit' => 11,
            ])
            ->addColumn('cc_apps', 'integer', [
                'default' => null,
                'null' => true,
                'limit' => 11,
            ])
            ->save();

        $table = $this->table('event_types');

        $table
            ->addColumn('payable_setting_id', 'integer', [
                'default' => null,
                'null' => true,
                'limit' => 11,
            ])
            ->addForeignKey('payable_setting_id', 'settings', ['id'])
            ->save();
    }
}
