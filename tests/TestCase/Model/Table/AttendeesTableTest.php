<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\User;
use App\Model\Table\AttendeesTable;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\AttendeesTable Test Case
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
            'id' => 13,
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
        $query = $this->Attendees->find('all');

        $startNow = Time::now();
        $nowDate = new Date('2016-12-26');

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
        $nowDate = new Date('2016-12-26');

        $badData = [
            'county' => null,
            'deleted' => null,
            'user_id' => null,
            'section_id' => null,
            'role_id' => null,
            'firstname' => null,
            'lastname' => null,
            'dateofbirth' => null,
            'phone' => null,
            'phone2' => null,
            'address_1' => null,
            'address_2' => null,
            'city' => null,
            'postcode' => null,
            'nightsawaypermit' => null,
            'vegetarian' => null,
            'created' => null,
            'modified' => null,
            'osm_generated' => null,
            'osm_id' => null,
            'osm_sync_date' => null,
            'user_attendee' => null,
        ];

        $goodData = [
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'New Person',
            'lastname' => 'Joe Other',
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
            'osm_id' => null,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];

        $expected = $this->getExpected();
        $inserted = $this->transformGood($goodData);
        $expected = array_merge($expected, [$inserted]);

        $badEntity = $this->Attendees->newEntity($badData);
        $goodEntity = $this->Attendees->newEntity($goodData);

        $this->assertFalse($this->Attendees->save($badEntity));
        $this->assertInstanceOf('\App\Model\Entity\Attendee', $this->Attendees->save($goodEntity));

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

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
        $nowDate = new Date('2016-12-26');

        $badSection = [
            'user_id' => 1,
            'section_id' => 12345,
            'role_id' => 1,
            'firstname' => 'New Person',
            'lastname' => 'Joe Other',
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
            'osm_id' => null,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];

        $badUser = [
            'user_id' => 12345,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'New Person',
            'lastname' => 'Joe Other',
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
            'osm_id' => null,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];

        $badRole = [
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 12345,
            'firstname' => 'New Person',
            'lastname' => 'Joe Other',
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
            'osm_id' => null,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];

        $goodData = [
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'New Person',
            'lastname' => 'Joe Other',
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
            'osm_id' => null,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
        ];

        $expected = $this->getExpected();
        $inserted = $this->transformGood($goodData);
        $expected = array_merge($expected, [$inserted]);

        $goodEntity = $this->Attendees->newEntity($goodData);
        $badSectionEntity = $this->Attendees->newEntity($badSection);
        $badUserEntity = $this->Attendees->newEntity($badUser);
        $badRoleEntity = $this->Attendees->newEntity($badRole);

        $this->assertInstanceOf('\App\Model\Entity\Attendee', $this->Attendees->save($goodEntity));
        $this->assertFalse($this->Attendees->save($badSectionEntity));
        $this->assertFalse($this->Attendees->save($badUserEntity));
        $this->assertFalse($this->Attendees->save($badRoleEntity));

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
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
