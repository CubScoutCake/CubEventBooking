<?php
use Migrations\AbstractMigration;

class Email extends AbstractMigration
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
        $table = $this->table('email_sends');

        $table->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('sent', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('message_id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('subject', 'string', [
                'default' => null,
                'limit' => 511,
                'null' => true,
            ])
            ->addColumn('routing_domain', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('from_address', 'string', [
                'default' => null,
                'limit' => 511,
                'null' => true,
            ])
            ->addColumn('friendly_from', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('notification_type_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('notification_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex('message_id')
            ->addIndex('user_id')
            ->addIndex('notification_id')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addForeignKey(
                'notification_id',
                'notifications',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addForeignKey(
                'notification_type_id',
                'notification_types',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->create();

        $table = $this->table('email_response_types');

        $table->addColumn('email_response_type', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('bounce', 'boolean', [
                'default' => false,
                'null' => false,
            ])
            ->create();

        $table = $this->table('email_responses');

        $table->addColumn('email_send_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('email_response_type_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('received', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('link_clicked', 'string', [
                'default' => null,
                'limit' => 511,
                'null' => true,
            ])
            ->addColumn('ip_address', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('bounce_reason', 'string', [
                'default' => null,
                'limit' => 511,
                'null' => true,
            ])
            ->addColumn('message_size', 'integer', [
                'default' => null,
                'null' => true,
            ])
            ->addIndex('email_send_id')
            ->addIndex('email_response_type_id')
            ->addForeignKey(
                'email_send_id',
                'email_sends',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addForeignKey(
                'email_response_type_id',
                'email_response_types',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->create();

        $table = $this->table('tokens');

        $table->addColumn('token', 'string', [
                'default' => null,
                'limit' => 511,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('email_send_id', 'integer', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('expires', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('utilised', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'null' => false,
            ])
            ->addIndex('email_send_id')
            ->addIndex('user_id')
            ->addForeignKey(
                'email_send_id',
                'email_sends',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->create();

        $table = $this->table('password_states');

        $table->addColumn('password_state', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('active', 'boolean', [
                'default' => true,
                'null' => false,
            ])
            ->addColumn('expired', 'boolean', [
                'default' => true,
                'null' => false,
            ])
            ->create();


        $table = $this->table('users');

        $table
	        ->changeColumn('pw_state', 'integer', [
		        'default' => null,
		        'null' => true,
	        ])
	        ->renameColumn('pw_state', 'password_state_id')
            ->addIndex('password_state_id')
            ->addForeignKey(
                'password_state_id',
                'password_states',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->save();
    }
}
