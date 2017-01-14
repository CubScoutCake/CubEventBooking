<?php
use Migrations\AbstractMigration;

class EventTypes extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('section_validated', 'integer',[
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('email_validated', 'integer',[
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('simple_attendees', 'integer',[
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->update();

        $table = $this->table('event_types');
        $table->addColumn('event_type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('simple_booking', 'boolean',[
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('date_of_birth', 'boolean',[
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('medical', 'boolean',[
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('parent_applications', 'boolean',[
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('invoice_text_id', 'integer',[
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('legal_text_id', 'integer',[
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])

            ->addIndex(['invoice_text_id'])
            ->addIndex(['legal_text_id'])
            ->create();


        $table = $this->table('events');
        $table->addColumn('event_type_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addForeignKey(
            'event_type_id',
            'event_types',
            'id',
            [
                'delete' => 'RESTRICT',
                'update' => 'CASCADE'
            ])
            ->addIndex(['event_type_id'])
            ->update();

        $table = $this->table('auth_roles');
        $table->addColumn('parent', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('user', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();
    }

    public function up()
    {
        $table = $this->table('events');
        $table->removeColumn('parent_applications')
            ->dropForeignKey(
                'invtext_id'
            )
            ->dropForeignKey(
                'legaltext_id'
            )
            ->removeColumn('logo_ratio')
            ->save();

        $table = $this->table('auth_roles');
        $table->removeColumn('auth')
            ->update();
    }
}
