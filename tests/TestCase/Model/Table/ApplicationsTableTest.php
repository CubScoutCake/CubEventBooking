<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationsTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\ApplicationsTable Test Case
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
        'app.allergies',
        'app.application_statuses',
        'app.applications_attendees',
        'app.applications',
        'app.attendees',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.champions',
        'app.discounts',
        'app.districts',
        'app.email_response_types',
        'app.email_responses',
        'app.email_sends',
        'app.event_statuses',
        'app.event_types',
        'app.events',
        'app.invoice_items',
        'app.invoices',
        'app.invoices_payments',
        'app.item_types',
        'app.logistic_items',
        'app.logistics',
        'app.notes',
        'app.notification_types',
        'app.notifications',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.password_states',
        'app.payments',
        'app.prices',
        'app.reservation_statuses',
        'app.reservations',
        'app.roles',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.setting_types',
        'app.settings',
        'app.users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Applications') ? [] : ['className' => 'App\Model\Table\ApplicationsTable'];
        $this->Applications = TableRegistry::get('Applications', $config);

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
        $timeNow = Time::now();

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
                'deleted' => null
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
                'deleted' => null
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
     * Test findCubs method
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
     * Test findYoungLeaders method
     *
     * @return void
     */
    public function testFindNonSection()
    {
        $query = $this->Applications->find('nonSection');
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(10, $query->count());

        $query = $this->Applications->find('nonSection', ['role_id' => 1]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(20, $query->count());

        $query = $this->Applications->find('nonSection', ['role_id' => 3]);
        $this->assertInstanceOf('Cake\ORM\Query', $query);

        $this->assertEquals(10, $query->count());
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
}
