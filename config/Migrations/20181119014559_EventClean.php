<?php

use Migrations\AbstractMigration;

class EventClean extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('events');

        $table
            ->removeColumn('cubs')
            ->removeColumn('cubs_value')
            ->removeColumn('cubs_text')
            ->removeColumn('yls')
            ->removeColumn('yls_value')
            ->removeColumn('yls_text')
            ->removeColumn('leaders')
            ->removeColumn('leaders_value')
            ->removeColumn('leaders_text')
            ->removeColumn('admin_firstname')
            ->removeColumn('admin_lastname')
            ->removeColumn('admin_email')
            ->removeColumn('address')
            ->removeColumn('city')
            ->removeColumn('county')
            ->removeColumn('postcode')
            ->removeColumn('tagline_text')
            ->removeColumn('logo_ratio')
            ->removeColumn('parent_applications')
            ->addColumn('opening_date', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('cc_res', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->addColumn('cc_atts', 'integer', [
                'default' => 0,
                'null' => false,
            ])
            ->save();
    }
}
