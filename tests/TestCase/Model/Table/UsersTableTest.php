<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\User;
use App\Model\Table\UsersTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Hash;
use Cake\Utility\Security;

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
        'app.Users',
        'app.Roles',
        'app.AuthRoles',
        'app.PasswordStates',
        'app.Scoutgroups',
        'app.Districts',
        'app.SectionTypes',
        'app.Sections',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);

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
            'legacy_section' => 'Lorem ipsum dolor sit amet',
            'osm_user_id' => 1,
            'osm_secret' => 'Lorem ipsum dolor sit amet',
            'osm_section_id' => 1,
            'osm_linked' => 1,
            'osm_current_term' => 1,
            'simple_attendees' => 1,
            'member_validated' => true,
            'section_validated' => true,
            'email_validated' => true,
            'full_name' => 'Jacob Tyler',
        ];
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $actual = $this->Users->get(1)->toArray();

        $dates = [
            'created',
            'modified',
            'osm_linkdate',
            'deleted',
            'last_login',
            'osm_term_end',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'role_id' => 1,
            'firstname' => 'Jacob',
            'lastname' => 'Tyler',
            'email' => 'jacob@fish.com',
            'phone' => '07801 999911',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'POST COD',
            'legacy_section' => 'Lorem ipsum dolor sit amet',
            'username' => 'Test',
            'osm_user_id' => 1,
            'osm_secret' => 'Lorem ipsum dolor sit amet',
            'osm_section_id' => 1,
            'osm_linked' => 1,
            'osm_current_term' => 1,
            'pw_reset' => 'Lorem ipsum dolor sit amet',
            'logins' => 1,
            'validated' => true,
            'api_key_plain' => 'Lorem ipsum dolor sit amet',
            'api_key' => 'Lorem ipsum dolor sit amet',
            'auth_role_id' => 1,
            'password_state_id' => 1,
            'membership_number' => 1,
            'section_id' => 1,
            'simple_attendees' => 1,
            'member_validated' => true,
            'section_validated' => true,
            'email_validated' => true,
            'full_name' => 'Jacob Tyler',
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Users->find('all')->count();
        $this->assertEquals(4, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->Users->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\User', $this->Users->save($new));

        $required = [
            'role_id',
            'section_id',
            'password_state_id',
            'auth_role_id',
            'firstname',
            'lastname',
            'email',
            'password',
            'phone',
            'address_1',
            'city',
            'county',
            'postcode',
            'username',
            'membership_number',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Users->newEntity($reqArray);
            $this->assertFalse($this->Users->save($new));
        }

        $notRequired = [
            'address_2',
            'legacy_section',
            'osm_user_id',
            'osm_secret',
            'osm_section_id',
            'osm_linked',
            'osm_current_term',
            'simple_attendees',
            'digest_hash',
            'pw_salt',
            'api_key_plain',
            'api_key',
            'last_login',
            'logins',
            'pw_reset',
            'validated',
            'member_validated',
            'section_validated',
            'email_validated',
        ];

        foreach ($notRequired as $notRequire) {
            $reqArray = $this->getGood();
            unset($reqArray[$notRequire]);
            $new = $this->Users->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\User', $this->Users->save($new));
        }

        $empties = [
            'address_2',
            'legacy_section',
            'osm_user_id',
            'osm_secret',
            'osm_section_id',
            'osm_linked',
            'osm_current_term',
            'simple_attendees',
            'digest_hash',
            'pw_salt',
            'api_key_plain',
            'api_key',
            'last_login',
            'logins',
            'pw_reset',
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->Users->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\User', $this->Users->save($new));
        }

        $notEmpties = [
            'role_id',
            'section_id',
            'password_state_id',
            'auth_role_id',
            'firstname',
            'lastname',
            'email',
            'password',
            'phone',
            'address_1',
            'city',
            'county',
            'postcode',
            'username',
            'membership_number',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->Users->newEntity($reqArray);
            $this->assertFalse($this->Users->save($new));
        }

        $maxLengths = [
            'api_key_plain' => 999,
            'api_key' => 999,
            'pw_salt' => 255,
            'pw_reset' => 255,
            'osm_secret' => 255,
            'username' => 45,
            'legacy_section' => 255,
            'postcode' => 8,
            'county' => 125,
            'city' => 125,
            'address_2' => 255,
            'address_1' => 255,
            'phone' => 12,
            'lastname' => 125,
            'firstname' => 125,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;
        $string .= $string;
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->Users->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\User', $this->Users->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->Users->newEntity($reqArray);
            $this->assertFalse($this->Users->save($new));
        }
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
     * Test beforeRules method
     *
     * @return void
     */
    public function testBeforeRules()
    {
        $before = $this->getGood();
        $changed = ['email', 'postcode', 'firstname', 'lastname', 'address_1', 'address_2', 'city', 'county'];

        foreach ($this->Users->upperCase as $field) {
            $this->assertTrue(in_array($field, $changed));
            $before[$field] = strtolower($before[$field]);
        }
        foreach ($this->Users->lowerCase as $field) {
            $this->assertTrue(in_array($field, $changed));
            $before[$field] = strtoupper($before[$field]);
        }
        foreach ($this->Users->initCase as $field) {
            $this->assertTrue(in_array($field, $changed));
            $before[$field] = strtoupper($before[$field]);
        }

        $new = $this->Users->newEntity($before);
        $this->Users->save($new);
        $after = $this->Users->get($new->id);

        foreach ($changed as $change) {
            $this->assertNotSame($before[$change], $after->get($change));
        }
    }

    /**
     * Test beforeRules method
     *
     * @return void
     */
    public function testBeforeMarshal()
    {
        $before = $this->getGood();
        $fieldsMarshaled = ['validated', 'member_validated', 'section_validated', 'email_validated'];

        foreach ($fieldsMarshaled as $field) {
            unset($before[$field]);
        }

        $new = $this->Users->newEntity($before);
        $this->assertInstanceOf(User::class, $new);

        foreach ($fieldsMarshaled as $field) {
            $this->assertFalse(is_null($new->get($field)));
            $this->assertTrue(is_bool($new->get($field)));
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

    /**
     * Test detectParent method
     *
     * @return void
     */
    public function testDetectParent()
    {
        foreach ($this->Users->find('all')->contain('AuthRoles') as $existing) {
            /** @var User $existing */
            $existingParent = [
                'firstname' => $existing->firstname,
                'lastname' => $existing->lastname,
                'email' => $existing->email,
                'postcode' => $existing->postcode,
            ];

            /** @var User $updated */
            $updated = $this->Users->detectParent($existingParent);
            $this->assertInstanceOf(User::class, $updated);

            if (!$existing->auth_role->parent_access) {
                $this->assertNotEquals($existing->auth_role_id, $updated->auth_role_id);
            } else {
                $this->assertEquals($existing->auth_role_id, $updated->auth_role_id);
            }
        }

        $newParent = [
            'firstname' => 'Joe',
            'lastname' => 'Llama',
            'email' => 'jacob@stargate.com',
            'postcode' => 'SG1 TAR',
        ];
        $this->assertFalse($this->Users->detectParent($newParent));
    }

    /**
     * Test detectParent method
     *
     * @return void
     */
    public function testDetectExisting()
    {
        $existingUser = [
            'firstname' => 'Jacob',
            'lastname' => 'Tyler',
            'email' => 'jacob@stargate.com',
            'postcode' => 'POST COD',
        ];
        $this->assertInstanceOf(User::class, $this->Users->detectExisting($existingUser));

        $newUser = [
            'firstname' => 'Joe',
            'lastname' => 'Llama',
            'email' => 'jacob@stargate.com',
            'postcode' => 'SG1 TAR',
        ];
        $this->assertFalse($this->Users->detectExisting($newUser));
    }

    /**
     * Test detectParent method
     *
     * @return void
     */
    public function testCreateParent()
    {
        $user = $this->Users->createParent([
            'firstname' => 'Jacob',
            'lastname' => 'Tyler',
            'email' => 'j.a.g.tyler@me.com',
            'phone' => '07804 918252',
            'address_1' => '17 Appleton Mead',
            'address_2' => '',
            'city' => 'Biggleswade',
            'county' => 'Bedfordshire',
            'country' => 'United Kingdom',
            'postcode' => 'SG18 8HS'
        ], 1);

        $this->assertInstanceOf('\App\Model\Entity\User', $user);
    }

    /**
     * Test detectParent method
     *
     * @return void
     */
    public function testCreateOrDetectParent()
    {
        foreach ($this->Users->find('all')->contain('AuthRoles') as $existing) {
            /** @var User $existing */
            $existingParent = $this->Users->get($existing->id, ['fields' => [
                'firstname',
                'lastname',
                'email',
                'phone',
                'address_1',
                'address_2',
                'city',
                'county',
                'postcode',
            ]])->toArray();

            /** @var User $updated */
            $updated = $this->Users->createOrDetectParent($existingParent, $existing->section_id);
            $this->assertInstanceOf(User::class, $updated);

            if (!$existing->auth_role->parent_access) {
                $this->assertNotEquals($existing->auth_role_id, $updated->auth_role_id);
            } else {
                $this->assertEquals($existing->auth_role_id, $updated->auth_role_id);
            }
        }

        $user = $this->Users->createOrDetectParent([
            'firstname' => 'Jacob',
            'lastname' => 'Tyler',
            'email' => 'j.a.g.tyler@me.com',
            'phone' => '07804 918252',
            'address_1' => '17 Appleton Mead',
            'address_2' => '',
            'city' => 'Biggleswade',
            'county' => 'Bedfordshire',
            'country' => 'United Kingdom',
            'postcode' => 'SG18 8HS'
        ], '1');

        $this->assertInstanceOf('\App\Model\Entity\User', $user);
    }
}
