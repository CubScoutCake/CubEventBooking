<?php
use Migrations\AbstractMigration;

class TasksInitialisation extends AbstractMigration
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
            ->table('users')
            ->removeColumn('section_validated')
            ->removeColumn('email_validated')
            ->update();

        $this
            ->table('users')
            ->addColumn('member_validated', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('section_validated', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('email_validated', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->update();

        $this
            ->table('task_types')
            ->addColumn('task_type', 'string', [
                'null' => false,
                'limit' => 255,
            ])
            ->addColumn('shared_type', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('type_icon', 'string', [
                'null' => false,
                'limit' => 15,
            ])
            ->addColumn('type_code', 'string', [
                'null' => false,
                'limit' => 3,
            ])
            ->addColumn('task_requirement', 'text')
            ->create();

        $this
            ->table('tasks')
            ->addColumn('task_type_id', 'integer', [
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
            ])
            ->addTimestamps('created', 'modified')
            ->addForeignKey(
                'task_type_id',
                'task_types',
                ['id'],
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                ['id'],
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->addColumn('completed', 'boolean', [
                'null' => false,
                'default' => false,
            ])
            ->addColumn('date_completed', 'datetime', [
                'null' => true,
            ])
            ->addColumn('completed_by_user_id', 'integer', [
                'null' => true,
            ])
            ->addForeignKey(
                'completed_by_user_id',
                'users',
                ['id'],
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                ]
            )
            ->addIndex('user_id')
            ->addIndex('task_type_id')
            ->create();
    }
}
