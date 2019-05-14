<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationsTable;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicationsTable Test Case
 */
class ApplicationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicationsTable
     */
    public $Applications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sessions',
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
        'app.allergies',
        'app.attendees_allergies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Applications') ? [] : ['className' => ApplicationsTable::class];
        $this->Applications = TableRegistry::getTableLocator()->get('Applications', $config);

        $now = new FrozenTime('2016-12-26 23:22:30');
        FrozenTime::setTestNow($now);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Applications);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $timeNow = FrozenTime::now();

        $query = $this->Applications->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'user_id' => 1,
                'section_id' => 1,
                'application_status_id' => 1,
                'legacy_section' => 'Cubs',
                'permit_holder' => 'Lorem as dolor sit amet',
                'team_leader' => 'Lorem as dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'modification' => 1,
                'event_id' => 2,
                'osm_event_id' => 1,
                'cc_att_total' => 1,
                'cc_att_cubs' => 1,
                'cc_att_yls' => 1,
                'cc_att_leaders' => 1,
                'cc_inv_count' => 1,
                'cc_inv_total' => 1,
                'cc_inv_cubs' => 1,
                'cc_inv_yls' => 1,
                'cc_inv_leaders' => 1,
                'deleted' => null,
                'hold_numbers' => '',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'section_id' => 1,
                'application_status_id' => 1,
                'legacy_section' => 'Cubs',
                'permit_holder' => 'Lorem as dolor sit amet',
                'team_leader' => 'Lorem as dolor sit amet',
                'created' => $timeNow,
                'modified' => $timeNow,
                'modification' => 1,
                'event_id' => 3,
                'osm_event_id' => 1,
                'cc_att_total' => 1,
                'cc_att_cubs' => 1,
                'cc_att_yls' => 1,
                'cc_att_leaders' => 1,
                'cc_inv_count' => 1,
                'cc_inv_total' => 1,
                'cc_inv_cubs' => 1,
                'cc_inv_yls' => 1,
                'cc_inv_leaders' => 1,
                'deleted' => null,
                'hold_numbers' => '',
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
        $this->markTestIncomplete('Not implemented yet.');
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
     * Test findOwnedBy method
     *
     * @return void
     */
    public function testFindOwnedBy()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUnarchived method
     *
     * @return void
     */
    public function testFindUnarchived()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findSection method
     *
     * @return void
     */
    public function testFindSection()
    {
        $query = $this->Applications->find('section');
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(10, $query->count());

        $query = $this->Applications->find('section', ['role_id' => 1]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(0, $query->count());

        $query = $this->Applications->find('section', ['role_id' => 3]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(10, $query->count());
    }

    /**
     * Test findNonSection method
     *
     * @return void
     */
    public function testFindNonSection()
    {
        $query = $this->Applications->find('nonSection');
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(9, $query->count());

        $query = $this->Applications->find('nonSection', ['role_id' => 1]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(19, $query->count());

        $query = $this->Applications->find('nonSection', ['role_id' => 3]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(9, $query->count());
    }

    /**
     * Test findLeaders method
     *
     * @return void
     */
    public function testFindLeaders()
    {
        $query = $this->Applications->find('leaders');
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(3, $query->count());
    }

    /**
     * Test findRoles method
     *
     * @return void
     */
    public function testFindRoles()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
