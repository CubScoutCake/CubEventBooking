<?php
use Migrations\AbstractMigration;

class NotificationTypeCode extends AbstractMigration
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
            ->table('notification_types')
            ->addColumn('type_code', 'string', [
                'limit' => 7,
                'null' => false,
                'default' => 'ABC-DEF'
            ])
            ->update();
    }
}
