<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AvailabilityComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AvailabilityComponent Test Case
 *
 * @property \App\Controller\Component\AvailabilityComponent $Availability
 */
class AvailabilityComponentTest extends TestCase
{

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
     * Test subject
     *
     * @var \App\Controller\Component\AvailabilityComponent
     */
    public $Availability;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Availability = new AvailabilityComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Availability);

        parent::tearDown();
    }

    /**
     * Test getApplicationNumbers method
     *
     * @return void
     */
    public function testGetApplicationNumbers()
    {
        // Application 1
        $numbers = $this->Availability->getApplicationNumbers(1);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 4,
            'NumLeaders' => 1,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);

        // Event 3
        $numbers = $this->Availability->getApplicationNumbers(3);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 5,
            'NumLeaders' => 2,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);
    }

    /**
     * Test getInvoiceNumbers method
     *
     * @return void
     */
    public function testGetInvoiceNumbers()
    {
        // Application 1
        $numbers = $this->Availability->getInvoiceNumbers(1);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 4,
            'NumLeaders' => 1,
        ];
        $this->assertEquals($expected, $numbers);
    }
}
