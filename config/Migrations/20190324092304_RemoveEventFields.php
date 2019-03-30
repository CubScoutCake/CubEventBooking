<?php
use Migrations\AbstractMigration;

class RemoveEventFields extends AbstractMigration
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
            ->table('events')
            ->removeColumn('invtext_id')
            ->removeColumn('legaltext_id')
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
            ->table('events')
            ->addColumn('invtext_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('legaltext_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addForeignKey(
                'invtext_id',
                'settings',
                ['id'],
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->addForeignKey(
                'legaltext_id',
                'settings',
                ['id'],
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT'
                ]
            )
            ->update();
    }
}
