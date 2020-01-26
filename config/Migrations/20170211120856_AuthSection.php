<?php

use Migrations\AbstractMigration;

class AuthSection extends AbstractMigration
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
        $table = $this->table('auth_roles');

        $table->addColumn('section_limited', 'boolean', [
                'null' => true,
            ])
            ->renameColumn('user', 'user_access')
            ->renameColumn('parent', 'parent_access')
            ->update();
    }
}
