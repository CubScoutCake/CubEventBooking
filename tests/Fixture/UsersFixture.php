<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'role_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'firstname' => ['type' => 'string', 'length' => 125, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'lastname' => ['type' => 'string', 'length' => 125, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'phone' => ['type' => 'string', 'length' => 12, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'address_1' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'address_2' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 125, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'county' => ['type' => 'string', 'length' => 125, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'postcode' => ['type' => 'string', 'length' => 8, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'legacy_section' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'username' => ['type' => 'string', 'length' => 45, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'osm_user_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'osm_secret' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'osm_section_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'osm_linked' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'osm_linkdate' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'osm_current_term' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'osm_term_end' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'pw_reset' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'last_login' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'logins' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'validated' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'deleted' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'digest_hash' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'pw_salt' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'api_key_plain' => ['type' => 'string', 'length' => 999, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'api_key' => ['type' => 'string', 'length' => 999, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'auth_role_id' => ['type' => 'integer', 'length' => 10, 'default' => '1', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'password_state_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'membership_number' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'section_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'simple_attendees' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'member_validated' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'section_validated' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'email_validated' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'users_role_id' => ['type' => 'index', 'columns' => ['role_id'], 'length' => []],
            'users_auth_role_id' => ['type' => 'index', 'columns' => ['auth_role_id'], 'length' => []],
            'users_password_state_id' => ['type' => 'index', 'columns' => ['password_state_id'], 'length' => []],
            'users_section_id' => ['type' => 'index', 'columns' => ['section_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'users_username' => ['type' => 'unique', 'columns' => ['username'], 'length' => []],
            'users_auth_role_id' => ['type' => 'foreign', 'columns' => ['auth_role_id'], 'references' => ['auth_roles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'users_password_state_id' => ['type' => 'foreign', 'columns' => ['password_state_id'], 'references' => ['password_states', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'users_role_id' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'users_section_id' => ['type' => 'foreign', 'columns' => ['section_id'], 'references' => ['sections', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'role_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'jacob@fish.com',
                'password' => 'Lorem ipsum dolor sit amet',
                'phone' => '07801 999911',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'POST COD',
                'legacy_section' => 'Lorem ipsum dolor sit amet',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'username' => 'Test',
                'osm_user_id' => 1,
                'osm_secret' => 'Lorem ipsum dolor sit amet',
                'osm_section_id' => 1,
                'osm_linked' => 1,
                'osm_linkdate' => date_create('2016-12-26 23:22:30'),
                'osm_current_term' => 1,
                'osm_term_end' => date_create('2016-12-26 23:22:30'),
                'pw_reset' => 'Lorem ipsum dolor sit amet',
                'last_login' => date_create('2016-12-26 23:22:30'),
                'logins' => 1,
                'validated' => 1,
                'deleted' => null,
                'digest_hash' => 'Lorem ipsum dolor sit amet',
                'pw_salt' => 'Lorem ipsum dolor sit amet',
                'api_key_plain' => 'Lorem ipsum dolor sit amet',
                'api_key' => 'Lorem ipsum dolor sit amet',
                'auth_role_id' => 1, // User
                'password_state_id' => 1,
                'membership_number' => 1,
                'section_id' => 1,
                'simple_attendees' => 1,
                'member_validated' => 1,
                'section_validated' => 1,
                'email_validated' => 1
            ],
            [
                'role_id' => 2,
                'section_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'j.a.g.tyler@bee.com',
                'password' => 'TestMe',
                'digest_hash' => 'b517225d7899cbd7d4c675b053d8f444',
                'pw_salt' => 'dev.hertscubs.uk',
                'api_key_plain' => 'a key',
                'api_key' => 'a key.P6JDH982',
                'phone' => 'NUMBER HERE',
                'address_1' => 'ADDRESS 1',
                'address_2' => '',
                'city' => 'ADDRESS 2',
                'county' => 'COUNTY',
                'postcode' => 'POSTCODE',
                'legacy_section' => '',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'username' => 'Jacob',
                'osm_user_id' => '111',
                'osm_secret' => '123',
                'osm_section_id' => '1242',
                'osm_linked' => 3,
                'osm_linkdate' => date_create('2016-12-26 23:22:30'),
                'osm_current_term' => '1422',
                'osm_term_end' => date_create('2016-12-26 23:22:30'),
                'pw_reset' => 'No Longer Active',
                'last_login' => date_create('2016-12-26 23:22:30'),
                'logins' => '12',
                'validated' => null,
                'deleted' => date_create('2016-12-26 23:22:30'),
                'auth_role_id' => 2, // SuperUser
                'password_state_id' => 1,
                'membership_number' => 123,
                'simple_attendees' => 1,
                'member_validated' => 1,
                'section_validated' => 1,
                'email_validated' => 1
            ],
            [
                'role_id' => 2,
                'section_id' => 1,
                'firstname' => 'Parent',
                'lastname' => 'Joe',
                'email' => 'llama@goat.com',
                'password' => 'TestMe',
                'digest_hash' => 'b517225d7899cbd7d4c675b053d8f444',
                'pw_salt' => 'dev.hertscubs.uk',
                'api_key_plain' => 'a key',
                'api_key' => 'a key.P6JDH982',
                'phone' => 'NUMBER HERE',
                'address_1' => 'ADDRESS 1',
                'address_2' => '',
                'city' => 'ADDRESS 2',
                'county' => 'COUNTY',
                'postcode' => 'POSTCODE',
                'legacy_section' => '',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'username' => 'PJoe',
                'osm_user_id' => '111',
                'osm_secret' => '123',
                'osm_section_id' => '1242',
                'osm_linked' => 3,
                'osm_linkdate' => date_create('2016-12-26 23:22:30'),
                'osm_current_term' => '1422',
                'osm_term_end' => date_create('2016-12-26 23:22:30'),
                'pw_reset' => 'No Longer Active',
                'last_login' => date_create('2016-12-26 23:22:30'),
                'logins' => '12',
                'validated' => null,
                'deleted' => null,
                'auth_role_id' => 3, // Admin
                'password_state_id' => 1,
                'membership_number' => 789,
                'simple_attendees' => 1,
                'member_validated' => 1,
                'section_validated' => 1,
                'email_validated' => 1
            ],
            [
                'role_id' => 2,
                'section_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Parent',
                'email' => 'goat@fish.monkey',
                'password' => 'TestMe',
                'digest_hash' => 'b517225d7899cbd7d4c675b053d8f444',
                'pw_salt' => 'dev.hertscubs.uk',
                'api_key_plain' => 'a key',
                'api_key' => 'a key.P6JDH982',
                'phone' => 'NUMBER HERE',
                'address_1' => 'ADDRESS 1',
                'address_2' => '',
                'city' => 'ADDRESS 2',
                'county' => 'COUNTY',
                'postcode' => 'POSTCODE',
                'legacy_section' => '',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'username' => 'JoeP',
                'osm_user_id' => '111',
                'osm_secret' => '123',
                'osm_section_id' => '1242',
                'osm_linked' => 3,
                'osm_linkdate' => date_create('2016-12-26 23:22:30'),
                'osm_current_term' => '1422',
                'osm_term_end' => date_create('2016-12-26 23:22:30'),
                'pw_reset' => 'No Longer Active',
                'last_login' => date_create('2016-12-26 23:22:30'),
                'logins' => '12',
                'validated' => null,
                'deleted' => null,
                'auth_role_id' => 4, // Parent
                'password_state_id' => 1,
                'membership_number' => 456,
                'simple_attendees' => 1,
                'member_validated' => 1,
                'section_validated' => 1,
                'email_validated' => 1
            ],
            [
                'role_id' => 2,
                'section_id' => 1,
                'firstname' => 'Admin',
                'lastname' => 'Joe',
                'email' => 'jacob@llama.com',
                'password' => 'TestMe',
                'digest_hash' => 'b517225d7899cbd7d4c675b053d8f444',
                'pw_salt' => 'dev.hertscubs.uk',
                'api_key_plain' => 'a key',
                'api_key' => 'a key.P6JDH982',
                'phone' => 'NUMBER HERE',
                'address_1' => 'ADDRESS 1',
                'address_2' => '',
                'city' => 'ADDRESS 2',
                'county' => 'COUNTY',
                'postcode' => 'POSTCODE',
                'legacy_section' => '',
                'created' => date_create('2016-12-26 23:22:30'),
                'modified' => date_create('2016-12-26 23:22:30'),
                'username' => 'AdminJoeP',
                'osm_user_id' => '111',
                'osm_secret' => '123',
                'osm_section_id' => '1242',
                'osm_linked' => 3,
                'osm_linkdate' => date_create('2016-12-26 23:22:30'),
                'osm_current_term' => '1422',
                'osm_term_end' => date_create('2016-12-26 23:22:30'),
                'pw_reset' => 'No Longer Active',
                'last_login' => date_create('2016-12-26 23:22:30'),
                'logins' => '12',
                'validated' => null,
                'deleted' => null,
                'auth_role_id' => 5, // Parent User
                'password_state_id' => 1,
                'membership_number' => 769213,
                'simple_attendees' => 1,
                'member_validated' => 1,
                'section_validated' => 1,
                'email_validated' => 1
            ],
        ];
        parent::init();
    }
}
