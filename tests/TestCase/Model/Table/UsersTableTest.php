<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\User;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.password_states',
        'app.districts',
        'app.champions',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
        'app.settings',
        'app.setting_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);

        $now = new Time('2016-12-26 23:22:30');
        Time::setTestNow($now);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $startNow = Time::now();

        $query = $this->Users->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'role_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'jacob@fish.com',
                'password' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'legacy_section' => 'Lorem ipsum dolor sit amet',
                'created' => $startNow,
                'modified' => $startNow,
                'username' => 'Test',
                'osm_user_id' => 1,
                'osm_secret' => 'Lorem ipsum dolor sit amet',
                'osm_section_id' => 1,
                'osm_linked' => 1,
                'osm_linkdate' => $startNow,
                'osm_current_term' => 1,
                'osm_term_end' => $startNow,
                'pw_reset' => 'Lorem ipsum dolor sit amet',
                'last_login' => $startNow,
                'logins' => 1,
                'validated' => true,
                'deleted' => null,
                'digest_hash' => 'Lorem ipsum dolor sit amet',
                'pw_salt' => 'Lorem ipsum dolor sit amet',
                'api_key_plain' => 'Lorem ipsum dolor sit amet',
                'api_key' => 'Lorem ipsum dolor sit amet',
                'auth_role_id' => 1,
                'password_state_id' => 1,
                'membership_number' => 1,
                'section_id' => 1
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $startNow = Time::now();

        $badData = [
            'role_id' => 1,
            'firstname' => null,
            'lastname' => null,
            'email' => null,
            'password' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor sit amet',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'legacy_section' => 'Lorem ipsum dolor sit amet',
            'created' => $startNow,
            'modified' => $startNow,
            'username' => 'Fish',
            'osm_user_id' => 12,
            'osm_secret' => 'Lorem ipsum dolor sit amet',
            'osm_section_id' => 134,
            'osm_linked' => 1,
            'osm_linkdate' => $startNow,
            'osm_current_term' => 12,
            'osm_term_end' => $startNow,
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'deleted' => null,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'auth_role_id' => 1,
            'password_state_id' => 1,
            'membership_number' => 123,
            'section_id' => 1
        ];

        $goodData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Fish',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $expected = [
            [
                'id' => 1,
                'role_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'jacob@fish.com',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'legacy_section' => 'Lorem ipsum dolor sit amet',
                'created' => $startNow,
                'modified' => $startNow,
                'username' => 'Test',
                'osm_user_id' => 1,
                'osm_secret' => 'Lorem ipsum dolor sit amet',
                'osm_section_id' => 1,
                'osm_linked' => 1,
                'osm_linkdate' => $startNow,
                'osm_current_term' => 1,
                'osm_term_end' => $startNow,
                'pw_reset' => 'Lorem ipsum dolor sit amet',
                'last_login' => $startNow,
                'logins' => 1,
                'validated' => true,
                'deleted' => null,
                'pw_salt' => 'Lorem ipsum dolor sit amet',
                'api_key_plain' => 'Lorem ipsum dolor sit amet',
                'api_key' => 'Lorem ipsum dolor sit amet',
                'auth_role_id' => 1,
                'password_state_id' => 1,
                'membership_number' => 1,
                'section_id' => 1
            ],
            [
                'id' => 3,
                'role_id' => 1,
                'section_id' => 1,
                'password_state_id' => 1,
                'auth_role_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Goat',
                'email' => 'jacob@goat.com',
                'phone' => '01982 987221',
                'address_1' => 'Lorem Ipsum Dolor Sit Amet',
                'address_2' => 'Lorem Ipsum Dolor Sit Amet',
                'city' => 'Lorem Ipsum Dolor Sit Amet',
                'county' => 'Lorem Ipsum Dolor Sit Amet',
                'postcode' => 'SG18 89S',
                'username' => 'Fish',
                'pw_reset' => 'Lorem ipsum dolor sit amet',
                'last_login' => $startNow,
                'logins' => 1,
                'validated' => true,
                'pw_salt' => 'Lorem ipsum dolor sit amet',
                'api_key_plain' => 'Lorem ipsum dolor sit amet',
                'api_key' => 'Lorem ipsum dolor sit amet',
                'membership_number' => 123,
                'legacy_section' => null,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_user_id' => null,
                'osm_secret' => null,
                'osm_section_id' => null,
                'osm_linked' => null,
                'osm_linkdate' => null,
                'osm_current_term' => null,
                'osm_term_end' => null,
                'deleted' => null,
            ],
        ];

        $badEntity = $this->Users->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Users->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Users->save($badEntity));
        $this->Users->save($goodEntity);

        $query = $this->Users->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $result = Hash::remove($result, '{n}.password');
        $result = Hash::remove($result, '{n}.digest_hash');

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $startNow = Time::now();

        $badRoleData = [
            'role_id' => 1234,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Llama',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $badAuthData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1234,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Llama',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $badSectionData = [
            'role_id' => 1,
            'section_id' => 1234,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'TesGTt',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $badPWStateData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1234,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'TesGTt',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $badUsernameData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Test',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $badEmailData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@fish.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Fish',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $badMembershipNumberData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Fish',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 1,
        ];

        $goodData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob@goat.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'SG18 89S',
            'username' => 'Fish',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $expected = [
            [
                'id' => 1,
                'role_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'jacob@fish.com',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'legacy_section' => 'Lorem ipsum dolor sit amet',
                'created' => $startNow,
                'modified' => $startNow,
                'username' => 'Test',
                'osm_user_id' => 1,
                'osm_secret' => 'Lorem ipsum dolor sit amet',
                'osm_section_id' => 1,
                'osm_linked' => 1,
                'osm_linkdate' => $startNow,
                'osm_current_term' => 1,
                'osm_term_end' => $startNow,
                'pw_reset' => 'Lorem ipsum dolor sit amet',
                'last_login' => $startNow,
                'logins' => 1,
                'validated' => true,
                'deleted' => null,
                'pw_salt' => 'Lorem ipsum dolor sit amet',
                'api_key_plain' => 'Lorem ipsum dolor sit amet',
                'api_key' => 'Lorem ipsum dolor sit amet',
                'auth_role_id' => 1,
                'password_state_id' => 1,
                'membership_number' => 1,
                'section_id' => 1
            ],
            [
                'id' => 3,
                'role_id' => 1,
                'section_id' => 1,
                'password_state_id' => 1,
                'auth_role_id' => 1,
                'firstname' => 'Jacob',
                'lastname' => 'Goat',
                'email' => 'jacob@goat.com',
                'phone' => '01982 987221',
                'address_1' => 'Lorem Ipsum Dolor Sit Amet',
                'address_2' => 'Lorem Ipsum Dolor Sit Amet',
                'city' => 'Lorem Ipsum Dolor Sit Amet',
                'county' => 'Lorem Ipsum Dolor Sit Amet',
                'postcode' => 'SG18 89S',
                'username' => 'Fish',
                'pw_reset' => 'Lorem ipsum dolor sit amet',
                'last_login' => $startNow,
                'logins' => 1,
                'validated' => true,
                'pw_salt' => 'Lorem ipsum dolor sit amet',
                'api_key_plain' => 'Lorem ipsum dolor sit amet',
                'api_key' => 'Lorem ipsum dolor sit amet',
                'membership_number' => 123,
                'legacy_section' => null,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_user_id' => null,
                'osm_secret' => null,
                'osm_section_id' => null,
                'osm_linked' => null,
                'osm_linkdate' => null,
                'osm_current_term' => null,
                'osm_term_end' => null,
                'deleted' => null,
            ],
        ];

        $badRoleEntity = $this->Users->newEntity($badRoleData);
        $badAuthEntity = $this->Users->newEntity($badAuthData);
        $badSectionEntity = $this->Users->newEntity($badSectionData);
        $badPWStateEntity = $this->Users->newEntity($badPWStateData);

        $badUsernameEntity = $this->Users->newEntity($badUsernameData);
        $badEmailEntity = $this->Users->newEntity($badEmailData);
        $badMembershipNumberEntity = $this->Users->newEntity($badMembershipNumberData);

        $goodEntity = $this->Users->newEntity($goodData);

        $this->assertFalse($this->Users->save($badRoleEntity));
        $this->assertFalse($this->Users->save($badAuthEntity));
        $this->assertFalse($this->Users->save($badSectionEntity));
        $this->assertFalse($this->Users->save($badPWStateEntity));

        $this->assertFalse($this->Users->save($badUsernameEntity));
        $this->assertFalse($this->Users->save($badEmailEntity));
        $this->assertFalse($this->Users->save($badMembershipNumberEntity));

        $this->assertInstanceOf(User::class, $this->Users->save($goodEntity));

        $query = $this->Users->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $result = Hash::remove($result, '{n}.password');
        $result = Hash::remove($result, '{n}.digest_hash');

        $this->assertEquals($expected, $result);
    }

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $startNow = Time::now();

        $password = 'Lorem ipsum dolor sit amet';

        $goodData = [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'jacOB',
            'lastname' => 'tylER',
            'email' => 'JaCoB@TyLeR.com',
            'password' => $password,
            'phone' => '01982 987221',
            'address_1' => 'letchworth HERE',
            'address_2' => 'llamaland GONTANOS',
            'city' => 'CHOOLOOSJ linguia',
            'county' => 'other world FISHY',
            'postcode' => 'sg6 ihj',
            'username' => 'Fish',
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => 123,
        ];

        $goodEntity = $this->Users->newEntity($goodData);

        $this->Users->save($goodEntity);

        $user = $this->Users->get('3');

        $this->assertNotEquals($goodData['password'], $user->password);
        $this->assertNotEquals($goodData['email'], $user->email);

        $this->assertNotEquals($goodData['firstname'], $user->firstname);
        $this->assertNotEquals($goodData['lastname'], $user->lastname);

        $this->assertNotEquals($goodData['address_1'], $user->address_1);
        $this->assertNotEquals($goodData['address_2'], $user->address_2);
        $this->assertNotEquals($goodData['city'], $user->city);
        $this->assertNotEquals($goodData['county'], $user->county);
        $this->assertNotEquals($goodData['postcode'], $user->postcode);
    }
}
