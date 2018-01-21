<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationsAttendeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicationsAttendeesTable Test Case
 */
class ApplicationsAttendeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicationsAttendeesTable
     */
    public $ApplicationsAttendees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applications_attendees',
        'app.applications',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.sections',
        'app.section_types',
        'app.invoices',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.events',
        'app.event_types',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.password_states',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ApplicationsAttendees') ? [] : ['className' => 'App\Model\Table\ApplicationsAttendeesTable'];
        $this->ApplicationsAttendees = TableRegistry::get('ApplicationsAttendees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicationsAttendees);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->ApplicationsAttendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();
        $expected = [
            [
                'application_id' => 1,
                'attendee_id' => 2
            ],
            [
                'application_id' => 1,
                'attendee_id' => 3
            ],
            [
                'application_id' => 1,
                'attendee_id' => 4
            ],
            [
                'application_id' => 1,
                'attendee_id' => 5
            ],
            [
                'application_id' => 1,
                'attendee_id' => 6
            ],
            [
                'application_id' => 1,
                'attendee_id' => 7
            ],
            [
                'application_id' => 1,
                'attendee_id' => 8
            ],
            [
                'application_id' => 1,
                'attendee_id' => 9
            ],
            [
                'application_id' => 1,
                'attendee_id' => 10
            ],
            [
                'application_id' => 1,
                'attendee_id' => 11
            ],
            [
                'application_id' => 1,
                'attendee_id' => 12
            ],
            [
                'application_id' => 3,
                'attendee_id' => 1
            ],
            [
                'application_id' => 3,
                'attendee_id' => 2
            ],
            [
                'application_id' => 3,
                'attendee_id' => 3
            ],
            [
                'application_id' => 3,
                'attendee_id' => 4
            ],
            [
                'application_id' => 3,
                'attendee_id' => 5
            ],
            [
                'application_id' => 3,
                'attendee_id' => 6
            ],
            [
                'application_id' => 3,
                'attendee_id' => 7
            ],
            [
                'application_id' => 3,
                'attendee_id' => 8
            ],
            [
                'application_id' => 3,
                'attendee_id' => 9
            ],
            [
                'application_id' => 3,
                'attendee_id' => 10
            ],
            [
                'application_id' => 3,
                'attendee_id' => 11
            ],
            [
                'application_id' => 3,
                'attendee_id' => 12
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $badData = [
            'application_id' => 98,
            'attendee_id' => 98
        ];

        $goodData = [
            'application_id' => 1,
            'attendee_id' => 1
        ];

        $expected = [
            [
                'application_id' => 1,
                'attendee_id' => 2
            ],
            [
                'application_id' => 1,
                'attendee_id' => 3
            ],
            [
                'application_id' => 1,
                'attendee_id' => 4
            ],
            [
                'application_id' => 1,
                'attendee_id' => 5
            ],
            [
                'application_id' => 1,
                'attendee_id' => 6
            ],
            [
                'application_id' => 1,
                'attendee_id' => 7
            ],
            [
                'application_id' => 1,
                'attendee_id' => 8
            ],
            [
                'application_id' => 1,
                'attendee_id' => 9
            ],
            [
                'application_id' => 1,
                'attendee_id' => 10
            ],
            [
                'application_id' => 1,
                'attendee_id' => 11
            ],
            [
                'application_id' => 1,
                'attendee_id' => 12
            ],
            [
                'application_id' => 3,
                'attendee_id' => 1
            ],
            [
                'application_id' => 3,
                'attendee_id' => 2
            ],
            [
                'application_id' => 3,
                'attendee_id' => 3
            ],
            [
                'application_id' => 3,
                'attendee_id' => 4
            ],
            [
                'application_id' => 3,
                'attendee_id' => 5
            ],
            [
                'application_id' => 3,
                'attendee_id' => 6
            ],
            [
                'application_id' => 3,
                'attendee_id' => 7
            ],
            [
                'application_id' => 3,
                'attendee_id' => 8
            ],
            [
                'application_id' => 3,
                'attendee_id' => 9
            ],
            [
                'application_id' => 3,
                'attendee_id' => 10
            ],
            [
                'application_id' => 3,
                'attendee_id' => 11
            ],
            [
                'application_id' => 3,
                'attendee_id' => 12
            ],
            [
                'application_id' => 1,
                'attendee_id' => 1
            ],
        ];

        $badEntity = $this->ApplicationsAttendees->newEntity($badData, ['accessibleFields' => ['*' => true]]);
        $goodEntity = $this->ApplicationsAttendees->newEntity($goodData, ['accessibleFields' => ['*' => true]]);

        $this->assertFalse($this->ApplicationsAttendees->save($badEntity));
        $this->ApplicationsAttendees->save($goodEntity);

        $query = $this->ApplicationsAttendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
