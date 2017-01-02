<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

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
        'app.districts',
        'app.champions',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
        'app.settings',
        'app.settingtypes'
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
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'role_id' => 1,
                'authrole' => 'Lorem ipsum dolor sit amet',
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@fish.com',
                'password' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'section' => 'Lorem ipsum dolor sit amet',
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
                'pw_state' => 1,
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
            'district' => null,
            'county' => null,
            'deleted' => null
        ];

        $goodData = [
            'id' => 3,
            'role_id' => 1,
            'authrole' => 'Lorem ipsum dolor sit amet',
            'firstname' => 'Lorem  dolor sit amet',
            'lastname' => 'Lorem  dolor sit amet',
            'email' => 'jacob@goat.com',
            'password' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor sit amet',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'section' => 'Lorem ipsum dolor sit amet',
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
            'pw_state' => 1,
            'membership_number' => 123,
            'section_id' => 1
        ];

        $expected = [
            [
                'id' => 1,
                'role_id' => 1,
                'authrole' => 'Lorem ipsum dolor sit amet',
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'email' => 'jacob@fish.com',
                'password' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'section' => 'Lorem ipsum dolor sit amet',
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
                'pw_state' => 1,
                'membership_number' => 1,
                'section_id' => 1
            ],
            [
                'id' => 3,
                'role_id' => 1,
                'authrole' => 'Lorem ipsum dolor sit amet',
                'firstname' => 'Lorem  dolor sit amet',
                'lastname' => 'Lorem  dolor sit amet',
                'email' => 'jacob@goat.com',
                'password' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'section' => 'Lorem ipsum dolor sit amet',
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
                'pw_state' => 1,
                'membership_number' => 123,
                'section_id' => 1
            ],
        ];

        $badEntity = $this->Users->newEntity($badData, ['accessibleFields' => ['id' => true]]);
        $goodEntity = $this->Users->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Users->save($badEntity));
        $this->Users->save($goodEntity);

        $query = $this->Users->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
