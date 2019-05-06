<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AvailabilityComponent;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AvailabilityComponent Test Case
 *
 * @property \App\Controller\Component\AvailabilityComponent $Availability
 * @property \App\Model\Table\ApplicationsTable Applications
 */
class AvailabilityComponentTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Allergies',
        'app.ApplicationStatuses',
        'app.ApplicationsAttendees',
        'app.Applications',
        'app.Attendees',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Champions',
        'app.Discounts',
        'app.Districts',
        'app.EmailResponseTypes',
        'app.EmailResponses',
        'app.EmailSends',
        'app.EventStatuses',
        'app.EventTypes',
        'app.Events',
        'app.InvoiceItems',
        'app.Invoices',
        'app.InvoicesPayments',
        'app.ItemTypes',
        'app.LogisticItems',
        'app.Logistics',
        'app.Notes',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.PasswordStates',
        'app.Payments',
        'app.Prices',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Roles',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.SettingTypes',
        'app.Settings',
        'app.Users',
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
     * Test getApplicationNumbers method
     *
     * @return void
     */
    public function testGetEventApplicationNumbers()
    {
        // Application 1
        $numbers = $this->Availability->getEventApplicationNumbers(2);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 4,
            'NumLeaders' => 1,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);

        // Event 3
        $numbers = $this->Availability->getEventApplicationNumbers(3);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 5,
            'NumLeaders' => 2,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);
    }

    /**
     * Test getApplicationNumbers method
     *
     * @return void
     */
    public function testGetEventNumbers()
    {
        // Application 1
        $numbers = $this->Availability->getEventNumbers(2);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 4,
            'NumLeaders' => 1,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);

        // Event 3
        $numbers = $this->Availability->getEventNumbers(3);

        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 5,
            'NumLeaders' => 2,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);
    }

    /**
     * Test getApplicationNumbers method
     *
     * @return void
     */
    public function testGetReservedNumbers()
    {
        // Application 1
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        $application = $this->Applications->get(3);

        $expected = [
            'NumSection' => 9,
            'NumNonSection' => 8,
            'NumLeaders' => 4,
            'NumTeams' => 1,
            'Reserved' => true,
        ];

        $holdNumbers = [
            'section' => 9,
            'non_section' => 8,
            'leaders' => 4,
        ];

        $application->set('hold_numbers', $holdNumbers);
        $application->set('application_status_id', 3);
        $this->Applications->save($application);

        // Event 3
        $numbers = $this->Availability->getApplicationNumbers(3);
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

    /**
     * Test getCheckBooking Type method
     *
     * @return void
     */
    public function testCheckBookingType()
    {
        $testData['booking_type'] = 'list';
        $response = $this->Availability->checkBooking(2, $testData, false);
        $this->assertTrue($response);
        $response = $this->Availability->checkBooking(3, $testData, false);
        $this->assertFalse($response);

        $testData['booking_type'] = 'hold';
        $response = $this->Availability->checkBooking(2, $testData, false);
        $this->assertTrue($response);
        $response = $this->Availability->checkBooking(3, $testData, false);
        $this->assertFalse($response);

        $testData['booking_type'] = 'district';
        $response = $this->Availability->checkBooking(2, $testData, false);
        $this->assertTrue($response);
        $response = $this->Availability->checkBooking(3, $testData, false);
        $this->assertFalse($response);
    }

    /**
     * Test getCheckBooking Attendees method
     *
     * @return void
     */
    public function testCheckBookingSection()
    {
        // Max for Event 2 is 6 - 6 Pass 7 Fail
        $testData['section'] = 6;
        $response = $this->Availability->checkBooking(2, $testData, false);
        $this->assertTrue($response);

        $testData['section'] = 7;
        $response = $this->Availability->checkBooking(2, $testData, false);
        $this->assertFalse($response);

        // Max for Event 3 is 5 - 5 Pass 6 Fail
        $testData['section'] = 5;
        $response = $this->Availability->checkBooking(2, $testData, false);
        $this->assertTrue($response);

        $testData['section'] = 6;
        $response = $this->Availability->checkBooking(3, $testData, false);
        $this->assertFalse($response);
    }
}
