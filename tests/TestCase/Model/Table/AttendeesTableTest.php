<?php
namespace App\Test\TestCase\Model\Table;

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

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Attendees->find('all');

        $startNow = Time::now();
        $now = new Time('2016-12-26 00:00:00');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $startNow,
                'user_attendee' => true,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joan',
                'lastname' => 'Arc',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 2,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joy',
                'lastname' => 'Lazz',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 3,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Goat',
                'lastname' => 'Fish',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 4,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Monkey',
                'lastname' => 'Nuts',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 5,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Julius',
                'lastname' => 'Cesar',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 6,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Brutus',
                'lastname' => 'Blob',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 7,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Joel',
                'lastname' => 'Plinky',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 8,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 9,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'King',
                'lastname' => 'Wensuslas',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 9,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 10,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Queen',
                'lastname' => 'LizzyFace',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 10,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 11,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Llama',
                'lastname' => 'FishTown',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 11,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 12,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Octoptus',
                'lastname' => 'Octocorn',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 12,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
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
        $now = new Time('2016-12-26 00:00:00');
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
            'cc_apps' => null,
        ];

        $goodData = [
            'county' => 'Lorem ipsum dolor sit amet',
            'deleted' => null,
            'user_id' => 1,
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'Lorem Joe dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'dateofbirth' => $now,
            'phone' => 'Lorem ipsum dolor sit amet',
            'phone2' => 'Lorem ipsum dolor sit amet',
            'address_1' => 'Lorem ipsum dolor sit amet',
            'address_2' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lorem ipsum dolor sit amet',
            'nightsawaypermit' => true,
            'vegetarian' => true,
            'created' => $startNow,
            'modified' => $startNow,
            'osm_generated' => true,
            'osm_id' => 1,
            'osm_sync_date' => $startNow,
            'user_attendee' => true,
            'cc_apps' => null,
        ];

        $expected = [
            [
                'id' => 1,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $startNow,
                'user_attendee' => true,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joan',
                'lastname' => 'Arc',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 2,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joy',
                'lastname' => 'Lazz',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 3,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Goat',
                'lastname' => 'Fish',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 4,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Monkey',
                'lastname' => 'Nuts',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 5,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Julius',
                'lastname' => 'Cesar',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 6,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Brutus',
                'lastname' => 'Blob',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 7,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Joel',
                'lastname' => 'Plinky',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 8,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 9,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'King',
                'lastname' => 'Wensuslas',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 9,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 10,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Queen',
                'lastname' => 'LizzyFace',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 10,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 11,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Llama',
                'lastname' => 'FishTown',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 11,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 12,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Octoptus',
                'lastname' => 'Octocorn',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 12,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 13,
                'county' => 'Lorem Ipsum Dolor Sit Amet',
                'deleted' => null,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Lorem Joe Dolor Sit Amet',
                'lastname' => 'Lorem Ipsum Dolor Sit Amet',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem Ipsum Dolor Sit Amet',
                'address_2' => 'Lorem Ipsum Dolor Sit Amet',
                'city' => 'Lorem Ipsum Dolor Sit Amet',
                'postcode' => 'LOREM IPSUM DOLOR SIT AMET',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $startNow,
                'user_attendee' => true,
                'cc_apps' => null,
            ],
        ];

        $badEntity = $this->Attendees->newEntity($badData);
        $goodEntity = $this->Attendees->newEntity($goodData, ['accessibleFields' => ['id' => true]]);

        $this->assertFalse($this->Attendees->save($badEntity));
        $this->Attendees->save($goodEntity);

        $query = $this->Attendees->find('all');

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
            'phone' => 'OLD',
            'phone2' => 'OLD',
            'address_1' => 'OLD',
            'address_2' => 'OLD',
            'city' => 'OLD',
            'postcode' => 'OLD',
            'nightsawaypermit' => false,
            'vegetarian' => false,
            'created' => $earlierNow,
            'modified' => $earlierNow,
            'osm_generated' => false,
            'osm_id' => null,
            'osm_sync_date' => null,
            'user_attendee' => false,
            'cc_apps' => null,
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
            'dateofbirth' => $now,
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
            'cc_apps' => null,
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
            'cc_apps' => null,
        ]; // New Address - Old OSM

        $expected = [
            [
                'id' => 1,
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'dateofbirth' => $nowDate,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $now,
                'modified' => $now,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $now,
                'user_attendee' => true,
                'cc_apps' => null,
            ],
            [
                'id' => 2,
                'county' => 'OLD',
                'deleted' => null,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $now,
                'phone' => 'OLD',
                'phone2' => 'OLD',
                'address_1' => 'OLD',
                'address_2' => 'OLD',
                'city' => 'OLD',
                'postcode' => 'OLD',
                'nightsawaypermit' => false,
                'vegetarian' => false,
                'created' => $now,
                'modified' => $now,
                'osm_generated' => false,
                'osm_id' => null,
                'osm_sync_date' => null,
                'user_attendee' => false,
                'cc_apps' => null,
            ],
            [
                'id' => 3,
                'county' => 'Lorem ipsum dolor sit amet',
                'deleted' => null,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $now,
                'phone' => '9901929',
                'phone2' => '99912 09921',
                'address_1' => 'RAW OLD',
                'address_2' => 'Lorem OLD dolor sit amet',
                'city' => 'Llama OLD',
                'postcode' => 'MK09 OOK',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $now,
                'modified' => $now,
                'osm_generated' => true,
                'osm_id' => 5,
                'osm_sync_date' => $now,
                'user_attendee' => true,
                'cc_apps' => null,
            ],
            [
                'id' => 4,
                'county' => 'OLD LLAMA',
                'deleted' => null,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $now,
                'phone' => '9901929',
                'phone2' => '99912 09921',
                'address_1' => 'RAW OLD',
                'address_2' => 'OLD',
                'city' => 'Llama OLD',
                'postcode' => 'MK09 OLD',
                'nightsawaypermit' => false,
                'vegetarian' => false,
                'created' => $now,
                'modified' => $laterNow,
                'osm_generated' => true,
                'osm_id' => 9,
                'osm_sync_date' => $laterNow,
                'user_attendee' => true,
                'cc_apps' => null,
            ],
        ];

        $goodEntity = $this->Attendees->newEntity($goodData, ['accessibleFields' => ['id' => true]]);
        $this->Attendees->save($goodEntity);

        $goodSecondEntity = $this->Attendees->newEntity($goodSecondData, ['accessibleFields' => ['id' => true]]);
        $this->Attendees->save($goodSecondEntity);

        $goodThirdEntity = $this->Attendees->newEntity($goodThirdData, ['accessibleFields' => ['id' => true]]);
        $this->Attendees->save($goodThirdEntity);

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);

        $this->Attendees->removeDuplicate(2);

        $query = $this->Attendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $expected = [
            [
                'id' => 1,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Joe',
                'lastname' => 'Bloggs',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $startNow,
                'user_attendee' => true,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joan',
                'lastname' => 'Arc',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 2,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 2,
                'firstname' => 'Joy',
                'lastname' => 'Lazz',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 3,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Goat',
                'lastname' => 'Fish',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 4,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Monkey',
                'lastname' => 'Nuts',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 5,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Julius',
                'lastname' => 'Cesar',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 6,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Brutus',
                'lastname' => 'Blob',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 7,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 8,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 3,
                'firstname' => 'Joel',
                'lastname' => 'Plinky',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 8,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 9,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'King',
                'lastname' => 'Wensuslas',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 9,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 10,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Queen',
                'lastname' => 'LizzyFace',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 10,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 11,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 5,
                'firstname' => 'Llama',
                'lastname' => 'FishTown',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => false,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 11,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 12,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Octoptus',
                'lastname' => 'Octocorn',
                'dateofbirth' => $now,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'county' => 'Lorem ipsum dolor sit amet',
                'postcode' => 'Lorem ipsum dolor sit amet',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 12,
                'osm_sync_date' => $startNow,
                'user_attendee' => false,
                'deleted' => null,
                'cc_apps' => null
            ],
            [
                'id' => 13,
                'county' => 'Lorem Ipsum Dolor Sit Amet',
                'deleted' => null,
                'user_id' => 1,
                'section_id' => 1,
                'role_id' => 1,
                'firstname' => 'Lorem Joe Dolor Sit Amet',
                'lastname' => 'Lorem Ipsum Dolor Sit Amet',
                'dateofbirth' => $nowDate,
                'phone' => 'Lorem ipsum dolor sit amet',
                'phone2' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem Ipsum Dolor Sit Amet',
                'address_2' => 'Lorem Ipsum Dolor Sit Amet',
                'city' => 'Lorem Ipsum Dolor Sit Amet',
                'postcode' => 'LOREM IPSUM DOLOR SIT AMET',
                'nightsawaypermit' => true,
                'vegetarian' => true,
                'created' => $startNow,
                'modified' => $startNow,
                'osm_generated' => true,
                'osm_id' => 1,
                'osm_sync_date' => $startNow,
                'user_attendee' => true,
                'cc_apps' => null,
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
