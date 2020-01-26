<?php

use Migrations\AbstractMigration;

class NotificationSoft extends AbstractMigration
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
        $table = $this->table('notifications');

        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ])
            ->update();

        $table = $this->table('email_sends');

        $table->addColumn('deleted', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->update();

        $table = $this->table('email_responses');

        $table->addColumn('deleted', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->update();

        $table = $this->table('tokens');

        $table->addColumn('deleted', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('hash', 'string', [
                'default' => null,
                'limit' => 511,
                'null' => true,
            ])
            ->addColumn('random_number', 'integer', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('header', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->update();
    }
}
