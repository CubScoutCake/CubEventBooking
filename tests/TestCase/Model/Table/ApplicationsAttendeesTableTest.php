<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\ApplicationsAttendee;
use App\Model\Table\ApplicationsAttendeesTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicationsAttendeesTable Test Case
 *
 * @property bool $travisPass
 *
 * @SuppressWarnings(PHPMD.LongVariable)
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
     *
    public $fixtures = [
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
        'app.notification_types',
        'app.notifications',
        'app.application_statuses',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.event_statuses',
        'app.discounts',
        'app.events',
        'app.prices',
        'app.applications',
        'app.task_types',
        'app.tasks',
        'app.attendees',
        'app.applications_attendees',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApplicationsAttendees') ? [] : ['className' => ApplicationsAttendeesTable::class];
        $this->ApplicationsAttendees = TableRegistry::getTableLocator()->get('ApplicationsAttendees', $config);

        $this->travisPass = Configure::read('travis');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicationsAttendees);
        unset($this->travisPass);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $query = $this->ApplicationsAttendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
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
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

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

        $badEntity = $this->ApplicationsAttendees->newEntity($badData);
        $goodEntity = $this->ApplicationsAttendees->newEntity($goodData);

        $this->assertFalse($this->ApplicationsAttendees->save($badEntity));
        $this->assertInstanceOf(ApplicationsAttendee::class, $this->ApplicationsAttendees->save($goodEntity));

        $query = $this->ApplicationsAttendees->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();

        $this->assertEquals($expected, $result);
    }
}
