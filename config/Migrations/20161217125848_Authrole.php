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
            ->addColumn('admin_access', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('champion_access', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('super_user', 'boolean', [
                'default' => null,
                'limit' => null,
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

        $data = [
            [
                'id' => 1,
                'auth_role' => 'User',
                'admin_access' => 0,
                'champion_access' => 0,
                'super_user' => 0,
                'auth' => 1,
            ],
        ];

        $table = $this->table('auth_roles');
        $table->insert($data)
            ->save();

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
            ->removeColumn('authrole')
            ->addColumn('membership_number', 'integer', [
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->renameColumn('section', 'legacy_section')
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
            ->renameColumn('legacy_section', 'section')
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
