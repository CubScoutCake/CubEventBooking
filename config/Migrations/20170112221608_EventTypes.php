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
            ->changeColumn('legacy_section','string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
                ])
            ->changeColumn('osm_secret','string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->changeColumn('address_2','string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->changeColumn('pw_reset','string', [
                'default' => null,
                'limit' => 255,
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
            ->addColumn('dietary', 'boolean',[
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
                'null' => false,
            ])
            ->addForeignKey(
            'event_type_id',
            'event_types',
            'id',
            [
                'delete' => 'RESTRICT',
                'update' => 'CASCADE'
            ])
            ->addColumn('section_type_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addForeignKey(
                'section_type_id',
                'section_types',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addIndex(['event_type_id'])
            ->addIndex(['section_type_id'])
            ->update();

        $table = $this->table('itemtypes');
        $table->renameColumn('roletype','role_id')
            ->addForeignKey(
                'role_id',
                'roles',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'RESTRICT'
                ])
            ->addColumn('available', 'boolean',[
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(['role_id'])
            ->renameColumn('itemtype', 'item_type')
            ->rename('item_types')
            ->update();

        $table = $this->table('invoice_items');
        $table->renameColumn('itemtype_id', 'item_type_id')
            ->update();

        $table = $this->table('notificationtypes');
        $table->rename('notification_types')
            ->update();

        $table = $this->table('notifications');
        $table->renameColumn('notificationtype_id','notification_type_id')
            ->update();

        $table = $this->table('settingtypes');
        $table->rename('setting_types')
            ->renameColumn('settingtype', 'setting_type')
            ->update();

        $table = $this->table('settings');
        $table->renameColumn('settingtype_id', 'setting_type_id')
            ->update();

        $table = $this->table('prices');
        $table->addColumn('item_type_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('event_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('max_number', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addForeignKey(
                'item_type_id',
                'item_types',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addForeignKey(
                'event_id',
                'events',
                'id',
                [
                    'delete' => 'RESTRICT',
                    'update' => 'CASCADE'
                ])
            ->addIndex(['item_type_id'])
            ->addIndex(['event_id'])
            ->create();

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
            ->removeIndex(['invtext_id'])
            ->removeIndex(['legaltext_id'])
            ->removeColumn('invtext_id')
            ->removeColumn('legaltext_id')
            ->removeColumn('logo_ratio')
            ->save();

        $table = $this->table('itemtypes');
        $table->removeColumn('minor')
            ->save();

        $table = $this->table('auth_roles');
        $table->removeColumn('auth')
            ->save();
    }
}
