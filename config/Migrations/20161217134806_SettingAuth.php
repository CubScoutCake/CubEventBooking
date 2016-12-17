<?php
use Migrations\AbstractMigration;

class SettingAuth extends AbstractMigration
{

    public function up()
    {

        $this->table('allergies')
            ->changeColumn('allergy', 'string')
            ->changeColumn('description', 'string')
            ->update();

        $this->table('applications')
            ->changeColumn('section', 'string')
            ->changeColumn('permitholder', 'string')
            ->changeColumn('eventname', 'string')
            ->update();

        $this->table('attendees')
            ->changeColumn('firstname', 'string')
            ->changeColumn('lastname', 'string')
            ->changeColumn('phone', 'string')
            ->changeColumn('phone2', 'string')
            ->changeColumn('address_1', 'string')
            ->changeColumn('address_2', 'string')
            ->changeColumn('city', 'string')
            ->changeColumn('county', 'string')
            ->changeColumn('postcode', 'string')
            ->update();

        $this->table('champions')
            ->changeColumn('firstname', 'string')
            ->changeColumn('lastname', 'string')
            ->changeColumn('email', 'string')
            ->update();

        $this->table('discounts')
            ->changeColumn('discount', 'string')
            ->changeColumn('code', 'string')
            ->changeColumn('text', 'string')
            ->update();

        $this->table('districts')
            ->changeColumn('district', 'string')
            ->changeColumn('county', 'string')
            ->update();

        $this->table('events')
            ->changeColumn('name', 'string')
            ->changeColumn('full_name', 'string')
            ->changeColumn('deposit_text', 'string')
            ->changeColumn('cubs_text', 'string')
            ->changeColumn('yls_text', 'string')
            ->changeColumn('leaders_text', 'string')
            ->changeColumn('logo', 'string')
            ->changeColumn('address', 'string')
            ->changeColumn('city', 'string')
            ->changeColumn('county', 'string')
            ->changeColumn('postcode', 'string')
            ->changeColumn('intro_text', 'string')
            ->changeColumn('tagline_text', 'string')
            ->changeColumn('location', 'string')
            ->changeColumn('admin_firstname', 'string')
            ->changeColumn('admin_lastname', 'string')
            ->changeColumn('admin_email', 'string')
            ->update();

        $this->table('invoice_items')
            ->changeColumn('Description', 'string')
            ->update();

        $this->table('itemtypes')
            ->changeColumn('itemtype', 'string')
            ->update();

        $this->table('logistics')
            ->changeColumn('header', 'string')
            ->changeColumn('text', 'string')
            ->update();

        $this->table('notes')
            ->changeColumn('note_text', 'string')
            ->update();

        $this->table('notifications')
            ->changeColumn('notification_header', 'string')
            ->changeColumn('text', 'string')
            ->changeColumn('notification_source', 'string')
            ->changeColumn('link_controller', 'string')
            ->changeColumn('link_prefix', 'string')
            ->changeColumn('link_action', 'string')
            ->update();

        $this->table('notificationtypes')
            ->changeColumn('notification_type', 'string')
            ->changeColumn('notification_description', 'string')
            ->changeColumn('icon', 'string')
            ->update();

        $this->table('parameter_sets')
            ->changeColumn('name', 'string')
            ->update();

        $this->table('parameters')
            ->changeColumn('parameter', 'string')
            ->changeColumn('constant', 'string')
            ->update();

        $this->table('params')
            ->changeColumn('constant', 'string')
            ->update();

        $this->table('payments')
            ->changeColumn('cheque_number', 'string')
            ->changeColumn('name_on_cheque', 'string')
            ->changeColumn('payment_notes', 'string')
            ->update();

        $this->table('roles')
            ->changeColumn('role', 'string')
            ->update();

        $this->table('scoutgroups')
            ->changeColumn('scoutgroup', 'string')
            ->update();

        $this->table('sessions')
            ->changeColumn('id', 'string')
            ->changeColumn('data', 'text')
            ->update();

        $this->table('settings')
            ->changeColumn('name', 'string')
            ->changeColumn('text', 'string')
            ->update();

        $this->table('settingtypes')
            ->changeColumn('settingtype', 'string')
            ->changeColumn('description', 'string')
            ->update();

        $this->table('users')
            ->changeColumn('authrole', 'string')
            ->changeColumn('firstname', 'string')
            ->changeColumn('lastname', 'string')
            ->changeColumn('email', 'string')
            ->changeColumn('password', 'string')
            ->changeColumn('phone', 'string')
            ->changeColumn('address_1', 'string')
            ->changeColumn('address_2', 'string')
            ->changeColumn('city', 'string')
            ->changeColumn('county', 'string')
            ->changeColumn('postcode', 'string')
            ->changeColumn('section', 'string')
            ->changeColumn('username', 'string')
            ->changeColumn('osm_secret', 'string')
            ->changeColumn('pw_reset', 'string')
            ->changeColumn('digest_hash', 'string')
            ->changeColumn('pw_salt', 'string')
            ->changeColumn('api_key_plain', 'string')
            ->changeColumn('api_key', 'string')
            ->update();

        $this->table('auth_roles')
            ->addColumn('auth', 'integer', [
                'default' => '1',
                'length' => 10,
                'null' => false,
            ])
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

        $this->table('allergies')
            ->changeColumn('allergy', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('description', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('applications')
            ->changeColumn('section', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('permitholder', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('eventname', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('attendees')
            ->changeColumn('firstname', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('lastname', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('phone', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('phone2', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('address_1', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('address_2', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('city', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('county', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('postcode', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('auth_roles')
            ->removeColumn('auth')
            ->update();

        $this->table('champions')
            ->changeColumn('firstname', 'string', [
                'default' => null,
                'length' => 125,
                'null' => false,
            ])
            ->changeColumn('lastname', 'string', [
                'default' => null,
                'length' => 125,
                'null' => false,
            ])
            ->changeColumn('email', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('discounts')
            ->changeColumn('discount', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('code', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('text', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->update();

        $this->table('districts')
            ->changeColumn('district', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('county', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('events')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 18,
                'null' => false,
            ])
            ->changeColumn('full_name', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('deposit_text', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('cubs_text', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('yls_text', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('leaders_text', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('logo', 'string', [
                'default' => '/Monkey.png',
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('address', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('city', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('county', 'string', [
                'default' => 'Hertfordshire',
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('postcode', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('intro_text', 'string', [
                'default' => null,
                'length' => 999,
                'null' => true,
            ])
            ->changeColumn('tagline_text', 'string', [
                'default' => null,
                'length' => 125,
                'null' => true,
            ])
            ->changeColumn('location', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->changeColumn('admin_firstname', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->changeColumn('admin_lastname', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->changeColumn('admin_email', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('invoice_items')
            ->changeColumn('Description', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();

        $this->table('itemtypes')
            ->changeColumn('itemtype', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->update();

        $this->table('logistics')
            ->changeColumn('header', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('text', 'string', [
                'default' => null,
                'length' => 999,
                'null' => true,
            ])
            ->update();

        $this->table('notes')
            ->changeColumn('note_text', 'string', [
                'default' => null,
                'length' => 999,
                'null' => true,
            ])
            ->update();

        $this->table('notifications')
            ->changeColumn('notification_header', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('text', 'string', [
                'default' => null,
                'length' => 999,
                'null' => true,
            ])
            ->changeColumn('notification_source', 'string', [
                'default' => null,
                'length' => 63,
                'null' => true,
            ])
            ->changeColumn('link_controller', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('link_prefix', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('link_action', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->update();

        $this->table('notificationtypes')
            ->changeColumn('notification_type', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('notification_description', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->changeColumn('icon', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->update();

        $this->table('parameter_sets')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();

        $this->table('parameters')
            ->changeColumn('parameter', 'string', [
                'default' => null,
                'length' => 45,
                'null' => true,
            ])
            ->changeColumn('constant', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();

        $this->table('params')
            ->changeColumn('constant', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();

        $this->table('payments')
            ->changeColumn('cheque_number', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->changeColumn('name_on_cheque', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->changeColumn('payment_notes', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();

        $this->table('roles')
            ->changeColumn('role', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->update();

        $this->table('scoutgroups')
            ->changeColumn('scoutgroup', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('sessions')
            ->changeColumn('id', 'string', [
                'default' => '',
                'length' => 40,
                'null' => false,
            ])
            ->changeColumn('data', 'text', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();

        $this->table('settings')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->changeColumn('text', 'string', [
                'default' => null,
                'length' => 999,
                'null' => false,
            ])
            ->update();

        $this->table('settingtypes')
            ->changeColumn('settingtype', 'string', [
                'default' => null,
                'length' => 45,
                'null' => false,
            ])
            ->changeColumn('description', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->removeColumn('min_auth')
            ->update();

        $this->table('users')
            ->changeColumn('authrole', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('firstname', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('lastname', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('email', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('password', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('phone', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('address_1', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('address_2', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('city', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('county', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('postcode', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('section', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('username', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('osm_secret', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('pw_reset', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('digest_hash', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->changeColumn('pw_salt', 'string', [
                'default' => null,
                'length' => 255,
                'null' => true,
            ])
            ->changeColumn('api_key_plain', 'string', [
                'default' => null,
                'length' => 999,
                'null' => true,
            ])
            ->changeColumn('api_key', 'string', [
                'default' => null,
                'length' => 999,
                'null' => true,
            ])
            ->update();
    }
}

