<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTable;
use Cake\I18n\FrozenTime;
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
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.application_statuses',
        'app.events',
        'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
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
                $this->assertInstanceOf('Cake\I18n\FrozenTime', $dateValue);
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
            'force_full' => false,
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
     * Test determineComplete method
     *
     * @return void
     */
    public function testDeterminePending()
    {
        // Event 2 Time = 2017-01-05T23:22:30+00:00
        $testArray = [
            '2016-12-26 23:22:30' => true, // 10 Days Before Opening
            '2017-01-05 23:21:30' => true, // 1 Minute Before Opening
            '2017-01-05 23:23:30' => false, // 1 Minute After Opening
            '2017-01-15 23:22:30' => false, // 10 Days After Opening
        ];

        foreach ($testArray as $time => $boolExpected) {
            $now = new FrozenTime($time);
            FrozenTime::setTestNow($now);

            $result = $this->Events->determinePending(2);
            if ($boolExpected) {
                $this->assertTrue($result);
            } else {
                $this->assertFalse($result);
            }
        }
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testDetermineStarted()
    {
        // Event 2 Time = 2017-01-05T23:22:30+00:00
        $testArray = [
            '2016-11-14 23:22:30' => false, // 2 Days Before Started
            '2016-11-16 23:21:30' => false, // 1 Minute Before Started
            '2016-11-16 23:23:30' => true, // 1 Minute After Started
            '2016-11-18 23:22:30' => true, // 2 Days After Started
        ];

        foreach ($testArray as $time => $boolExpected) {
            $now = new FrozenTime($time);
            FrozenTime::setTestNow($now);

            $result = $this->Events->determineStarted(2);
            if ($boolExpected) {
                $this->assertTrue($result);
            } else {
                $this->assertFalse($result);
            }
        }
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testDetermineClosed()
    {
        // Event 2 Time = 2017-01-25T23:22:30+00:00
        $testArray = [
            '2016-12-26 23:22:30' => false, // 10 Days Before Started
            '2017-01-25 23:21:30' => false, // 1 Minute Before Started
            '2017-01-25 23:23:30' => true, // 1 Minute After Started
            '2017-02-15 23:22:30' => true, // 10 Days After Started
        ];

        foreach ($testArray as $time => $boolExpected) {
            $now = new FrozenTime($time);
            FrozenTime::setTestNow($now);

            $result = $this->Events->determineClosed(2);
            if ($boolExpected) {
                $this->assertTrue($result);
            } else {
                $this->assertFalse($result);
            }
        }
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testDetermineOver()
    {
        // Event 2 Time = 2016-11-15T23:22:30+00:00
        $testArray = [
            '2016-11-05 23:22:30' => false, // 10 Days Before Started
            '2016-11-15 23:21:30' => false, // 1 Minute Before Started
            '2016-11-15 23:23:30' => true, // 1 Minute After Started
            '2016-11-25 23:22:30' => true, // 10 Days After Started
        ];

        foreach ($testArray as $time => $boolExpected) {
            $now = new FrozenTime($time);
            FrozenTime::setTestNow($now);

            $result = $this->Events->determineOver(2);
            if ($boolExpected) {
                $this->assertTrue($result);
            } else {
                $this->assertFalse($result);
            }
        }
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testDetermineEventStatus()
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get(2);

        $this->Events->EventStatuses->installBaseStatuses();
        FrozenTime::setTestNow('2019-01-01 18:00:00');

        $event->set('opening_date', '2019-01-05 18:00:00');
        $event->set('closing_date', '2019-01-10 18:00:00');
        $event->set('start_date', '2019-01-15 18:00:00');
        $event->set('end_date', '2019-01-20 18:00:00');

        $this->Events->save($event, ['validate' => false]);

        // New - 2
        $event->set('cc_prices', 0);
        $this->Events->save($event, ['validate' => false]);

        $this->assertTrue($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertFalse($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(2, $this->Events->determineEventStatus(2));

        // Ready - 3
        $event->set('cc_prices', 3);
        $this->Events->save($event, ['validate' => false]);

        $this->assertTrue($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(3, $this->Events->determineEventStatus(2));

        // Open - 4
        FrozenTime::setTestNow('2019-01-06 18:00:00');

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(4, $this->Events->determineEventStatus(2));

        // Full - 5 - Applications
        FrozenTime::setTestNow('2019-01-11 18:00:00');
        $event->set('max', true);
        $event->set('max_apps', 3);
        $event->set('cc_apps', 3);
        $this->Events->save($event, ['validate' => false]);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertTrue($this->Events->determineFull(2));

        $this->assertEquals(5, $this->Events->determineEventStatus(2));

        // Full - 5 - Reservations
        FrozenTime::setTestNow('2019-01-11 18:00:00');
        $event->set('cc_apps', 0);
        $event->set('cc_res', 3);
        $this->Events->save($event, ['validate' => false]);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertTrue($this->Events->determineFull(2));

        $this->assertEquals(5, $this->Events->determineEventStatus(2));

        FrozenTime::setTestNow('2019-01-11 18:00:00');
        $event->set('max', false);
        $event->set('cc_apps', 0);
        $event->set('cc_res', 0);
        $this->Events->save($event, ['validate' => false]);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(4, $this->Events->determineEventStatus(2));

        $event->set('force_full', true);
        $this->Events->save($event, ['validate' => false]);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertTrue($this->Events->determineFull(2));

        $this->assertEquals(5, $this->Events->determineEventStatus(2));

        // In Progress - 6
        FrozenTime::setTestNow('2019-01-16 18:00:00');

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertTrue($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));

        $this->assertEquals(6, $this->Events->determineEventStatus(2));

        // Over - 7
        FrozenTime::setTestNow('2019-01-21 18:00:00');

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertTrue($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertTrue($this->Events->determineOver(2));

        $this->assertEquals(7, $this->Events->determineEventStatus(2));
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

    /**
     * Test findUpcoming method
     *
     * @return void
     */
    public function testSchedule()
    {
        $this->Events->EventStatuses->installBaseStatuses();
        $event = $this->Events->get(2);
        FrozenTime::setTestNow('2019-01-01 18:00:00');

        $event->set('opening_date', '2019-01-05 18:00:00');
        $event->set('closing_date', '2019-01-10 18:00:00');
        $event->set('start_date', '2019-01-15 18:00:00');
        $event->set('end_date', '2019-01-20 18:00:00');

        $this->Events->save($event, ['validate' => false]);

        // Fixture to Real
        $this->assertTrue($this->Events->schedule(2));

        // Real to Real
        $this->assertFalse($this->Events->schedule(2));

        // Time Change
        FrozenTime::setTestNow('2019-01-16 18:00:00');
        $this->assertTrue($this->Events->schedule(2));
    }

    /**
     * Test determineComplete method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get(2);

        $this->Events->EventStatuses->installBaseStatuses();
        FrozenTime::setTestNow('2019-01-01 18:00:00');

        $event->set('opening_date', '2019-01-05 18:00:00');
        $event->set('closing_date', '2019-01-10 18:00:00');
        $event->set('start_date', '2019-01-15 18:00:00');
        $event->set('end_date', '2019-01-20 18:00:00');

        $this->Events->save($event, ['validate' => false]);

        // New - 2
        $event->set('cc_prices', 0);
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);
        $event->set('cc_prices', 0);
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $this->assertTrue($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertFalse($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(2, $event->event_status_id);

        // Ready - 3
        $event->set('cc_prices', 3);
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);
        $event->set('cc_prices', 3);
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $this->assertTrue($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(3, $event->event_status_id);

        // Open - 4
        FrozenTime::setTestNow('2019-01-06 18:00:00');
        $event->set('full_name', 'My TEST EVENT');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);
        $event->set('full_name', 'My TEST EVENT');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertFalse($this->Events->determineFull(2));

        $this->assertEquals(4, $event->event_status_id);

        // Full - 5
        FrozenTime::setTestNow('2019-01-11 18:00:00');
        $event->set('max', true);
        $event->set('max_section', 3);
        $event->set('cc_apps', 3);
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $event->set('full_name', 'LLAMA TEST');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertFalse($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));
        $this->assertTrue($this->Events->determineFull(2));

        $this->assertEquals(5, $event->event_status_id);

        // In Progress - 6
        FrozenTime::setTestNow('2019-01-16 18:00:00');
        $event->set('full_name', 'My Goat EVENT');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $event->set('full_name', 'FISH TEST');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertTrue($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertFalse($this->Events->determineOver(2));

        $this->assertEquals(6, $event->event_status_id);

        // Over - 7
        FrozenTime::setTestNow('2019-01-21 18:00:00');
        $event->set('full_name', 'My Fave EVENT');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $event->set('full_name', 'LLAMA TEST');
        $this->Events->save($event, ['validate' => false]);
        $event = $this->Events->get(2);

        $this->assertFalse($this->Events->determinePending(2));
        $this->assertTrue($this->Events->determineStarted(2));
        $this->assertTrue($this->Events->determineComplete(2));
        $this->assertTrue($this->Events->determineOver(2));

        $this->assertEquals(7, $event->event_status_id);
    }
}
