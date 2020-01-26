<?php

use Migrations\AbstractMigration;

class EmailSendCode extends AbstractMigration
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
            ->table('email_sends')
            ->addColumn('email_generation_code', 'string', [
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('email_template', 'string', [
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('include_token', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->renameColumn('message_id', 'message_send_code')
            ->update();
    }
}
