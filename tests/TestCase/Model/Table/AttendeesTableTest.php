<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\Attendees;
use App\Model\Table\AttendeesTable;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\ModelLevel\Table\AttendeesTable Test Case
 *
 * @property AttendeesTable $Attendees
 */
class AttendeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendeesTable
     */
    public $Attendees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.scoutgroups',
        'app.districts',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Attendees') ? [] : ['className' => 'App\Model\Table\AttendeesTable'];
        $this->Attendees = TableRegistry::get('Attendees', $config);

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
        unset($this->Attendees);

        parent::tearDown();
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    private function getGood()
    {
        $startNow = Time::now();
        $nowDate = new Date('2016-12-26');

        return [
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'New Person' . random_int(1, 999) . random_int(1, 999),
            'lastname' => 'Joe Other' . random_int(1, 999) . random_int(1, 999),
            'dateofbirth' => $nowDate,
            'phone' => '01234 567890',
            'phone2' => null,
            'address_1' => 'Lorem Ipsum Dolor Sit Amet',
            'address_2' => 'Lorem Ipsum Dolor Sit Amet',
            'city' => 'Lorem Ipsum Dolor Sit Amet',
            'county' => 'Lorem Ipsum Dolor Sit Amet',
            'postcode' => 'AB1 3DE',
            'nightsawaypermit' => true,
            'vegetarian' => true,
            'osm_generated' => false,
            'osm_id' => random_int(1, 999) . random_int(1, 999),
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];
    }

    public function getExpected()
    {
        $startNow = Time::now();
        $nowDate = new Date('2016-12-26');

        return $expectedArray = [
            [
                'id' => 1,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $startNow,
                'user_attendee' => true,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joan',
                'lastname' => 'Arc',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => false,
                'osm_id' => null,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joy',
                'lastname' => 'Lazz',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 3,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Goat',
                'lastname' => 'Fish',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 4,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Monkey',
                'lastname' => 'Nuts',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 5,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Julius',
                'lastname' => 'Cesar',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 6,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Brutus',
                'lastname' => 'Blob',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 7,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Joel',
                'lastname' => 'Plinky',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 8,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 9,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'King',
                'lastname' => 'Wensuslas',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 9,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 10,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Queen',
                'lastname' => 'Lizzy Face',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 10,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 11,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Llama',
                'lastname' => 'Fish Town',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 11,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
            [
                'id' => 12,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Octoptus',
                'lastname' => 'Octocorn',
                'dateofbirth' => $nowDate,
                'phone' => '01234 567890',
                'phone2' => null,
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'AB1 3DE',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 12,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => 0,
            ],
        ];
    }

    public function transformGood($inserted, $id = 13)
    {
        $startNow = Time::now();
        $nowDate = new Date('2016-12-26');

        $addition = [
            'id' => $id,
            'cc_apps' => 0,
            'deleted' => null,
            'created' => $startNow,
            'modified' => $startNow,
        ];

        $inserted = $this->Attendees->changeArrayCase($inserted);

        return array_merge($inserted, $addition);
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $actual = $this->Attendees->get(1)->toArray();

        $dates = [
            'modified',
            'created',
            'deleted',
            'osm_sync_date'
        ];

        $this->assertInstanceOf('Cake\I18n\Date', $actual['dateofbirth']);
        unset($actual['dateofbirth']);

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'Joe',
            'lastname' => 'Bloggs',
            'phone' => '01234 567890',
            'phone2' => null,
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'AB1 3DE',
            'nightsawaypermit' => 1,
            'vegetarian' => 1,
            'osm_generated' => true,
            'osm_id' => 1,
            'user_attendee' => true,
            'cc_apps' => 0,
            'full_name' => 'Joe Bloggs'
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Attendees->find('all')->count();
        $this->assertEquals(12, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     *
     * @throws
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->Attendees->newEntity($good);
        $attempt = $this->Attendees->save($new);

        $this->assertNotFalse($attempt);
        $this->assertInstanceOf('App\Model\Entity\Attendee', $attempt);

        $required = [
            'firstname',
            'lastname',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Attendees->newEntity($reqArray);
            $this->assertFalse($this->Attendees->save($new));
        }

        $notRequired = [
            'phone',
            'phone2',
            'address_1',
            'address_2',
            'city',
            'county',
            'postcode',
            'nightsawaypermit',
            'vegetarian',
            'osm_generated',
            'osm_id',
            'user_attendee',
            'osm_sync_date',
        ];

        foreach ($notRequired as $not_required) {
            $reqArray = $this->getGood();
            unset($reqArray[$not_required]);
            $new = $this->Attendees->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($new));
        }

        $empties = [
            'phone',
            'phone2',
            'address_1',
            'address_2',
            'city',
            'county',
            'postcode',
            'nightsawaypermit',
            'vegetarian',
            'osm_generated',
            'osm_id',
            'user_attendee',
            'osm_sync_date',
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->Attendees->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($new));
        }

        $notEmpties = [
            'firstname',
            'lastname',
        ];

        foreach ($notEmpties as $not_empty) {
            $reqArray = $this->getGood();
            $reqArray[$not_empty] = '';
            $new = $this->Attendees->newEntity($reqArray);
            $this->assertFalse($this->Attendees->save($new));
        }

        $maxLengths = [
            'firstname' => 255,
            'lastname' => 255,
            'phone' => 12,
            'phone2' => 12,
            'address_1' => 255,
            'address_2' => 255,
            'city' => 125,
            'county' => 125,
            'postcode' => 8,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $max_length) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $max_length);
            $new = $this->Attendees->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $max_length + 1);
            $new = $this->Attendees->newEntity($reqArray);
            $this->assertFalse($this->Attendees->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testBuildRules()
    {
        // Users
        $values = $this->getGood();

        $types = $this->Attendees->Users->find('list')->toArray();

        $type = max(array_keys($types));

        $values['user_id'] = $type;
        $new = $this->Attendees->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($new));

        $values = $this->getGood();

        $values['user_id'] = $type + 100;
        $new = $this->Attendees->newEntity($values);
        $this->assertFalse($this->Attendees->save($new));

        // Sections
        $values = $this->getGood();

        $types = $this->Attendees->Sections->find('list')->toArray();

        $type = max(array_keys($types));

        $values['section_id'] = $type;
        $new = $this->Attendees->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($new));

        $values = $this->getGood();

        $values['section_id'] = $type + 100;
        $new = $this->Attendees->newEntity($values);
        $this->assertFalse($this->Attendees->save($new));

        // Roles
        $values = $this->getGood();

        $types = $this->Attendees->Roles->find('list')->toArray();

        $type = max(array_keys($types));

        $values['role_id'] = $type;
        $new = $this->Attendees->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($new));

        $values = $this->getGood();

        $values['role_id'] = $type + 100;
        $new = $this->Attendees->newEntity($values);
        $this->assertFalse($this->Attendees->save($new));
    }

    /**
     * Test isOwnedBy method
     *
     * @return void
     */
    public function testIsOwnedBy()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findCountIncluded method
     *
     * @return void
     */
    public function testFindCountIncluded()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findOsm method
     *
     * @return void
     */
    public function testFindOsm()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUnattached method
     *
     * @return void
     */
    public function testFindUnattached()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test Before Rules Event Trigger
     *
     * @return void
     */
    public function testCaseBeforeRules()
    {
        $startNow = Time::now();
        $nowDate = new Date('2016-12-26');

        $caseData = [
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'wrONg CasE',
            'lastname' => 'LAST name',
            'dateofbirth' => $nowDate,
            'phone' => '01234 567890',
            'phone2' => null,
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'sh1 3ib',
            'nightsawaypermit' => true,
            'vegetarian' => true,
            'osm_generated' => true,
            'osm_id' => 987654,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];

        $caseEntity = $this->Attendees->newEntity($caseData);

        $this->assertInstanceOf('\App\Model\Entity\Attendee', $this->Attendees->save($caseEntity));

        $this->Attendees->changeArrayCase($caseData);

        $expected = $this->getExpected();
        $inserted = $this->transformGood($caseData);

        $expected = array_merge($expected, [$inserted]);

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test Check Duplicate
     *
     * @return void
     */
    public function testCheckDuplicate()
    {
        $expectedAttendees = $this->getExpected();

        foreach ($expectedAttendees as $expected_attendee) {
            $attendeeEnt = $this->Attendees->get($expected_attendee['id']);

            $newEntityData = [];
            $extractedData = [
                'user_id',
                'section_id',
                'role_id',
                'firstname',
                'lastname',
                'osm_id',
                'osm_generated'
            ];

            foreach ($extractedData as $extract) {
                $newEntityData = array_merge($newEntityData, [$extract => $attendeeEnt->get($extract)]);
            }

            $newEntity = $this->Attendees->newEntity($newEntityData);

            $this->assertTrue($newEntity->isNew());

            $newEntity = $this->Attendees->checkDuplicate($newEntity);

            $this->assertFalse($newEntity->isNew());
        }
    }

    /**
     * Test Before Rules Event Trigger
     *
     * @return void
     */
    public function testDuplicateBeforeRules()
    {
        $expectedAttendees = $this->getExpected();

        $att = $expectedAttendees[0];
        $existing = $this->Attendees->get($att['id']);
        $this->assertInstanceOf('App\Model\Entity\Attendee', $this->Attendees->save($existing));

        $notDeleted = [];
        foreach ($expectedAttendees as $deletedAttendee) {
            if (is_null($deletedAttendee['deleted'])) {
                $notDeleted = array_merge($notDeleted, [$deletedAttendee]);
            }
        }

        foreach ($notDeleted as $expected_attendee) {
            $attendeeEnt = $this->Attendees->get($expected_attendee['id']);

            $newEntityData = [];
            $extractedData = [
                'user_id',
                'section_id',
                'role_id',
                'firstname',
                'lastname',
                'osm_id',
                'osm_generated'
            ];

            foreach ($extractedData as $extract) {
                $newEntityData = array_merge($newEntityData, [$extract => $attendeeEnt->get($extract)]);
            }
            $newEntity = $this->Attendees->newEntity($newEntityData);
            $this->assertTrue($newEntity->isNew());
            $response = $this->Attendees->save($newEntity);
            $this->assertInstanceOf('App\Model\Entity\Attendee', $response);
        }

        $startNow = Time::now();
        $nowDate = new Date('2016-12-26');

        $caseData = [
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'wrONg CasE',
            'lastname' => 'LAST name',
            'dateofbirth' => $nowDate,
            'phone' => '01234 567890',
            'phone2' => null,
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'county' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'sh1 3ib',
            'nightsawaypermit' => true,
            'vegetarian' => true,
            'osm_generated' => true,
            'osm_id' => 987654,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];
        $new = $this->Attendees->newEntity($caseData);
        $this->assertInstanceOf('\App\Model\Entity\Attendee', $this->Attendees->save($new));

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $expected = array_merge($expectedAttendees, [$this->transformGood($caseData)]);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test findUnattached method
     *
     * @return void
     */
    public function testRemoveDuplicate()
    {
        $this->markTestIncomplete();

        $nowDate = new Date('2016-12-26'); // Date Only

        $earlierNow = new Time('2016-11-26 23:22:30'); // 1

        $now = new Time('2016-12-26 23:22:30'); // 2

        $laterNow = new Time('2017-01-26 23:22:30'); // 3

        $goodData = [
            'id' => 2,
            'county' => 'OLD',
            'deleted' => null,
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'Joe',
            'lastname' => 'Bloggs',
            'dateofbirth' => $earlierNow,
            'phone' => '01234 567890',
            'phone2' => null,
            'address_1' => 'OLD',
            'address_2' => 'OLD',
            'city' => 'OLD',
            'postcode' => 'AB1 3DE',
            'nightsawaypermit' => false,
            'vegetarian' => false,
            'created' => $earlierNow,
            'modified' => $earlierNow,
            'osm_generated' => false,
            'osm_id' => null,
            'osm_sync_date' => null,
            'user_attendee' => false,
            'cc_apps' => 0,
        ]; // Fully Old Base

        $goodSecondData = [
            'id' => 3,
            'county' => 'Lorem ipsum dolor sit amet',
            'deleted' => null,
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'Joe',
            'lastname' => 'Bloggs',
            'dateofbirth' => $nowDate,
            'phone' => '9901929',
            'phone2' => '99912 09921',
            'address_1' => 'RAW OLD',
            'address_2' => 'Lorem OLD dolor sit amet',
            'city' => 'Llama OLD',
            'postcode' => 'MK09 OOK',
            'nightsawaypermit' => false,
            'vegetarian' => false,
            'created' => $now,
            'modified' => $now,
            'osm_generated' => true,
            'osm_id' => 5,
            'osm_sync_date' => $laterNow,
            'user_attendee' => false,
            'cc_apps' => 0,
        ]; // New OSM - OLD Address

        $goodThirdData = [
            'id' => 4,
            'county' => 'NEW LLAMA',
            'deleted' => null,
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'Joe',
            'lastname' => 'Bloggs',
            'dateofbirth' => $laterNow,
            'phone' => '1111',
            'phone2' => '99912 1111',
            'address_1' => 'RAW NEW',
            'address_2' => 'NEW',
            'city' => 'Llama NEW',
            'postcode' => 'MK09 NEW',
            'nightsawaypermit' => true,
            'vegetarian' => true,
            'created' => $now,
            'modified' => $laterNow,
            'osm_generated' => true,
            'osm_id' => 9,
            'osm_sync_date' => $now,
            'user_attendee' => true,
            'cc_apps' => 0,
        ]; // New Address - Old OSM


        $goodEntity = $this->Attendees->newEntity($goodData, ['accessibleFields' => ['id' => true]]);
        $this->Attendees->save($goodEntity);

        $goodSecondEntity = $this->Attendees->newEntity($goodSecondData, ['accessibleFields' => ['id' => true]]);
        $this->Attendees->save($goodSecondEntity);

        $goodThirdEntity = $this->Attendees->newEntity($goodThirdData, ['accessibleFields' => ['id' => true]]);
        $this->Attendees->save($goodThirdEntity);

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);

        $this->Attendees->removeDuplicate(2);

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
