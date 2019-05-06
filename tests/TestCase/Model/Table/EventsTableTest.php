<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTable;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsTable
     */
    public $Events;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Prices',
        'app.ItemTypes',
        'app.InvoiceItems',
        'app.Invoices',
        'app.Users',
        'app.Roles',
        'app.PasswordStates',
        'app.Attendees',
        'app.Sections',
        'app.SectionTypes',
        'app.Scoutgroups',
        'app.Districts',
        'app.Champions',
        'app.Applications',
        'app.ApplicationStatuses',
        'app.Events',
        'app.EventStatuses',
        'app.Settings',
        'app.SettingTypes',
        'app.Discounts',
        'app.Logistics',
        'app.Parameters',
        'app.ParameterSets',
        'app.Params',
        'app.LogisticItems',
        'app.Notes',
        'app.ApplicationsAttendees',
        'app.Allergies',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Notifications',
        'app.NotificationTypes',
        'app.Payments',
        'app.InvoicesPayments',
        'app.EventTypes',
        'app.Reservations',
        'app.ReservationStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Events') ? [] : ['className' => EventsTable::class];
        $this->Events = TableRegistry::getTableLocator()->get('Events', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Events);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $actual = $this->Events->get(2)->toArray();

        $dates = [
            'start_date',
            'end_date',
            'created',
            'modified',
            'deleted',
            'deposit_date',
            'closing_date',
            'opening_date',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 2,
            'name' => 'OLD dolo',
            'full_name' => 'Lorem Goat dolor sit amet',
            'live' => true,
            'new_apps' => true,
            'deposit' => true,
            'deposit_inc_leaders' => true,
            'logo' => 'Lorem ipsum dolor sit amet',
            'discount_id' => null,
            'intro_text' => 'Lorem ipsum dolor sit amet',
            'location' => 'Lorem ipsum dolor sit amet',
            'max' => true,
            'allow_reductions' => true,
            'invoices_locked' => true,
            'admin_user_id' => 5,
            'max_apps' => 2,
            'max_section' => 20,
            'event_type_id' => 1,
            'section_type_id' => 2,
            'cc_apps' => 1,
            'cc_prices' => 2,
            'complete' => false,
            'team_price' => true,
            'event_status_id' => 1,
            'cc_res' => 1,
            'cc_atts' => 1,
            'app_full' => false,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Events->find('all')->count();
        $this->assertEquals(2, $count);
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
     * Test findUnarchived method
     *
     * @return void
     */
    public function testFindUnarchived()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUpcoming method
     *
     * @return void
     */
    public function testFindUpcoming()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testDetermineComplete()
    {
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertTrue($this->Events->determineComplete(3));
    }

    /**
     * Test findUpcoming method
     *
     * @return void
     */
    public function testGetPriceSection()
    {
        // Team Price Event
        $section = $this->Events->getPriceSection(2);
        $this->assertEquals(6, $section);

        // Individual Price Event
        $section = $this->Events->getPriceSection(3);
        $this->assertEquals(5, $section);
    }
}
