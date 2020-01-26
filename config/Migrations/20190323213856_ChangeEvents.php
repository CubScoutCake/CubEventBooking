<?php

use Migrations\AbstractMigration;

class ChangeEvents extends AbstractMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $this
            ->table('logistic_items')
            ->addIndex(['reservation_id'])
            ->update();

        $this
            ->table('events')
            ->removeColumn('max_cubs')
            ->removeColumn('max_yls')
            ->removeColumn('max_leaders')
            ->removeColumn('deposit_value')
            ->removeColumn('deposit_text')
            ->update();

        $this
            ->table('events')
            ->addForeignKey(
                'admin_user_id',
                'users',
                ['id'],
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function down()
    {
        $this
            ->table('logistic_items')
            ->removeIndex(['reservation_id'])
            ->update();

        $this
            ->table('events')
            ->addColumn('max_cubs', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('max_yls', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('max_leaders', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('deposit_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deposit_text', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->update();

        $this
            ->table('events')
            ->dropForeignKey('admin_user_id')
            ->update();
    }
}
