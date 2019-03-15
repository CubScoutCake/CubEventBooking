<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ProgressComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ProgressComponent Test Case
 *
 * @property ProgressComponent $Progress
 */
class ProgressComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ProgressComponent
     */
    public $Progress;

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
        $registry = new ComponentRegistry();
        $this->Progress = new ProgressComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Progress);

        parent::tearDown();
    }

    /**
     * Test determineApp method
     *
     * @return void
     */
    public function testDetermineApp()
    {
        $componentResponse = $this->Progress->determineApp(1, false, 1, false, false, false);

        $expected = [
            'done' => 1,
            'appDone' => 1,
            'invDone' => 1,
            'cubsDone' => 1,
            'cubsNotDone' => 1,
            'payDone' => 1,
            'status' => 'success',
        ];
        $this->assertEquals($expected, $componentResponse);

        $componentResponse = $this->Progress->determineApp(3, false, 1, false, false, false);

        $expected = [
            'done' => 1,
            'appDone' => 1,
            'invDone' => 1,
            'cubsDone' => 1,
            'cubsNotDone' => 1,
            'payDone' => 1,
            'status' => 'success',
        ];
        $this->assertEquals($expected, $componentResponse);

        // Test Full Admin response

        $componentResponse = $this->Progress->determineApp(1, true, 1, false, true, false);

        $expected = [
            'invCount' => 1,
            'invCubs' => 5,
            'invYls' => 4,
            'invLeaders' => 1,
            'invNotCubs' => 5,
            'attCubs' => 5,
            'attYls' => 4,
            'attLeaders' => 1,
            'attNotCubs' => 5,
            'sumBalances' => 0.0,
            'sumPayments' => 1.0,
            'sumValues' => 1.0,
            'appDone' => 1,
            'invDone' => 1,
            'cubsDone' => 1,
            'cubsNotDone' => 1,
            'payDone' => 1,
            'done' => 1,
            'status' => 'success',
        ];
        $this->assertEquals($expected, $componentResponse);

        $componentResponse = $this->Progress->determineApp(3, true, 1, false, true, false);

        $expected = [
            'invCount' => 1,
            'invCubs' => 0,
            'invYls' => 0,
            'invLeaders' => 0,
            'invNotCubs' => 0,
            'attCubs' => 5,
            'attYls' => 5,
            'attLeaders' => 2,
            'attNotCubs' => 7,
            'sumBalances' => 0.0,
            'sumPayments' => 1.0,
            'sumValues' => 1.0,
            'appDone' => 1,
            'invDone' => 1,
            'cubsDone' => 1,
            'cubsNotDone' => 1,
            'payDone' => 1,
            'done' => 1,
            'status' => 'success',
        ];
        $this->assertEquals($expected, $componentResponse);
    }

    /**
     * Test cacheApps method
     *
     * @return void
     */
    public function testCacheApps()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
