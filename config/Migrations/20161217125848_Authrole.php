<?php
use Migrations\AbstractMigration;

class Authrole extends AbstractMigration
{

    public function up()
    {
        $this->table('auth_roles')
            ->addColumn('auth_role', 'string', [
                'default' => 'user',
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('admin_access', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('champion_access', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('super_user', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => true,
            ])
            ->addColumn('auth', 'integer', [
                'default' => '1',
                'length' => 10,
                'null' => false,
            ])
            ->addIndex(
                [
                    'auth_role',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('users')
            ->renameColumn('reset', 'pw_reset')
            ->addColumn('auth_role_id', 'integer', [
                'default' => 1,
                'length' => 10,
                'null' => false,
            ])
            ->addColumn('pw_state', 'integer', [
                'default' => '1',
                'length' => 10,
                'null' => true,
            ])
            ->addColumn('membership_number', 'integer', [
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'auth_role_id',
                ]
            )
            ->update();

        $this->table('users')
            ->addForeignKey(
                'auth_role_id',
                'auth_roles',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();

        $this->table('settingtypes')
            ->addColumn('min_auth', 'integer', [
                'default' => '100',
                'length' => 10,
                'null' => false,
            ])
            ->update();
    }

    public function down()
    {
        $this->table('users')
            ->dropForeignKey(
                'auth_role_id'
            );

        $this->table('users')
            ->renameColumn('pw_reset', 'reset')
            ->removeColumn('auth_role_id')
            ->removeColumn('pw_state')
            ->removeColumn('membership_number')
            ->update();

        $this->table('settingtypes')
            ->removeColumn('min_auth')
            ->update();

        $this->dropTable('auth_roles');
    }
}

