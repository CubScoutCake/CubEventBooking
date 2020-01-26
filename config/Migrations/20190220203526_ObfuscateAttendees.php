<?php

use Migrations\AbstractMigration;

class ObfuscateAttendees extends AbstractMigration
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
            ->table('attendees')
            ->addColumn('identity_hash', 'string', [
                'limit' => 255,
                'null' => true,
            ])
            ->addIndex('identity_hash', [
                'unique' => true,
            ])
            ->addColumn('obfuscated', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();

        $this
            ->table('allergies')
            ->addColumn('is_medical', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('is_specific', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('is_dietary', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();
    }
}
