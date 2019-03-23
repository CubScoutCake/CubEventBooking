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
     * Return Expected Array
     *
     * @return array
     */
    private function getExpected()
    {
        $startNow = Time::now();

        return [
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
            [
                'id' => 3,
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
                'created' => $startNow,
                'modified' => $startNow,
                'username' => 'PJoe',
                'osm_user_id' => '111',
                'osm_secret' => '123',
                'osm_section_id' => '1242',
                'osm_linked' => 3,
                'osm_linkdate' => $startNow,
                'osm_current_term' => '1422',
                'osm_term_end' => $startNow,
                'pw_reset' => 'No Longer Active',
                'last_login' => $startNow,
                'logins' => '12',
                'validated' => null,
                'deleted' => null,
                'auth_role_id' => 3,
                'password_state_id' => 1,
                'membership_number' => 789,
            ],
            [
                'id' => 4,
                'role_id' => 2,
                'section_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Parent',
                'email' => 'j.a.g.tyler@me.com',
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
                'created' => $startNow,
                'modified' => $startNow,
                'username' => 'JoeP',
                'osm_user_id' => '111',
                'osm_secret' => '123',
                'osm_section_id' => '1242',
                'osm_linked' => 3,
                'osm_linkdate' => $startNow,
                'osm_current_term' => '1422',
                'osm_term_end' => $startNow,
                'pw_reset' => 'No Longer Active',
                'last_login' => $startNow,
                'logins' => '12',
                'validated' => null,
                'deleted' => null,
                'auth_role_id' => 4,
                'password_state_id' => 1,
                'membership_number' => 456,
            ],
        ];
    }

    /**
     * Get Good Entity Data
     *
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        $startNow = Time::now();

        return [
            'role_id' => 1,
            'section_id' => 1,
            'password_state_id' => 1,
            'auth_role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Goat',
            'email' => 'jacob' . random_int(111, 999) . '@goat' . random_int(111, 999) . '.com',
            'password' => 'HASHEDHASHYHASHHASH',
            'phone' => '01982 987221',
            'address_1' => 'Lorem Ipsum Dolor Sit Amet',
            'address_2' => 'Lorem Ipsum Dolor Sit Amet',
            'city' => 'Lorem Ipsum Dolor Sit Amet',
            'county' => 'Lorem Ipsum Dolor Sit Amet',
            'postcode' => 'SG18 89S',
            'username' => random_int(111, 999) . 'Fish' . random_int(111, 999),
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'last_login' => $startNow,
            'logins' => 1,
            'validated' => true,
            'digest_hash' => 'Lorem ipsum dolor sit amet',
            'pw_salt' => 'Lorem ipsum dolor sit amet',
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'membership_number' => random_int(1111, 9999) + random_int(119, 9919),
        ];
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Users->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = $this->getExpected();

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

        $goodData = $this->getGood();

        $expected = $this->getExpected();

        $badEntity = $this->Users->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Users->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Users->save($badEntity));
        $this->Users->save($goodEntity);

        $query = $this->Users->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $result = Hash::remove($result, '{n}.password');
        $result = Hash::remove($result, '{n}.digest_hash');

        array_push($expected, array_merge($goodData, [
            'id' => 5,
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
        ]));

        $expected = Hash::remove($expected, '{n}.password');
        $expected = Hash::remove($expected, '{n}.digest_hash');

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $unique = ['username', 'email', 'membership_number'];
        $first = $this->Users->find('all')->first();

        foreach ($unique as $field) {
            $good = $this->getGood();
            $this->assertInstanceOf(User::class, $this->Users->save($this->Users->newEntity($good)));

            $good = $this->getGood();
            $fieldEnt = $this->Users->newEntity($good);

            $fieldEnt->set($field, $first->get($field));
            $this->assertFalse($this->Users->save($fieldEnt));
        }
    }

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $goodData = $this->getGood();

        $goodEntity = $this->Users->newEntity($goodData);

        $this->Users->save($goodEntity);

        $user = $this->Users->get('3');

        $fields = ['password', 'email', 'firstname', 'lastname', 'address_1', 'address_2', 'city', 'county', 'postcode'];
        foreach ($fields as $field) {
            $this->assertNotEquals($goodData[$field], $user->get($field));
        }
    }

    /**
     * Test Parents Finder
     *
     * @return void
     */
    public function testFindParents()
    {
        $normal = $this->Users->find('all')->count();

        $parentFinder = $this->Users->find('parents');

        $parents = $parentFinder->count();
        $this->assertLessThan($normal, $parents);

        $parent = $parentFinder->first();
        $this->assertInstanceOf(User::class, $parent);
    }
}
