<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\BookingComponent;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\BookingComponent Test Case
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 */
class BookingComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\BookingComponent
     */
    public $Booking;

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
        'app.reservation_statuses',
        'app.reservations',
        'app.invoices',
        'app.invoice_items',
        'app.payments',
        'app.invoices_payments',
        'app.notes',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.logistics',
        'app.logistic_items',
        'app.email_sends',
        'app.tokens',
        'app.email_response_types',
        'app.email_responses',
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
        $this->Booking = new BookingComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Booking);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test GuessSectionType Function
     *
     * @return void
     */
    public function testGuessSectionType()
    {
        $roles = TableRegistry::get('Roles');

        // Six Year Old Beaver
        $sixYearOld = FrozenTime::now();
        $sixYearOld = $sixYearOld->subYears(6);
        $response = $this->Booking->guessRole($sixYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Beaver', $beaver->role);

        // Nine Year Old Cub
        $nineYearOld = FrozenTime::now();
        $nineYearOld = $nineYearOld->subYears(9);
        $response = $this->Booking->guessRole($nineYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Cub', $beaver->role);

        // Twelve Year Old Scout
        $twelveYearOld = FrozenTime::now();
        $twelveYearOld = $twelveYearOld->subYears(12);
        $response = $this->Booking->guessRole($twelveYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Scout', $beaver->role);

        // Fifteen Year Old Explorer
        $fifteenYearOld = FrozenTime::now();
        $fifteenYearOld = $fifteenYearOld->subYears(15);
        $response = $this->Booking->guessRole($fifteenYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Explorer', $beaver->role);

        // Twenty Year Old Leader
        $twentyYearOld = FrozenTime::now();
        $twentyYearOld = $twentyYearOld->subYears(20);
        $response = $this->Booking->guessRole($twentyYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Leader', $beaver->role);

        $response = $this->Booking->guessRole('8sajgs');
        $this->assertFalse($response);
    }

    /**
     * Test GuessSectionType Function
     *
     * @return void
     */
    public function testAddReservation()
    {
        $this->Reservations = TableRegistry::getTableLocator()->get('Reservations');
        $this->Reservations->ReservationStatuses->installBaseStatuses();

        $testData = [
            'user' => [
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'farm@me.com',
                'phone' => '07799 123456',
                'address_1' => '17 Piglet Mead',
                'address_2' => '',
                'city' => 'Farmland',
                'county' => 'Farmshire',
                'country' => 'United Kingdom',
                'postcode' => 'FARM 123'
            ],
            'attendee' => [
                'firstname' => 'Timmy',
                'lastname' => 'Tyler',
                'section_id' => '1'
            ],
            'logistics_item' => [
                0 => [
                    'logistic_id' => 1,
                    'param_id' => 2,
                ]
            ],
        ];

        $reservation = $this->Reservations->newEntity();
        $response = $this->Booking->addReservation($reservation, 3, $testData, false);
        $this->assertNotFalse($response);

        $firstRes = $this->Reservations->get(2, ['contain' => ['Invoices', 'LogisticItems']]);
        $this->assertTrue(preg_match('/[0-9]+\-[0-9]+\-[A-Z]{3}/', $firstRes->reservation_number) !== 0);
        $this->assertNotEmpty($firstRes->invoice);
        $this->assertNotEmpty($firstRes->logistic_items);

        // Check Second Child Works
        $testData['attendee']['firstname'] = 'Julie';
        $reservation = $this->Reservations->newEntity();
        $response = $this->Booking->addReservation($reservation, 3, $testData, false);
        $this->assertNotFalse($response);

        $secondRes = $this->Reservations->get(3, ['contain' => ['Invoices', 'LogisticItems']]);
        $this->assertTrue(preg_match('/[0-9]+\-[0-9]+\-[A-Z]{3}/', $secondRes->reservation_number) !== 0);
        $this->assertNotEmpty($secondRes->invoice);
        $this->assertNotEmpty($secondRes->logistic_items);

        // Assert Session Full
        $testData['attendee']['firstname'] = 'Julian';
        $reservation = $this->Reservations->newEntity();
        $response = $this->Booking->addReservation($reservation, 3, $testData, false);
        $this->assertFalse($response);

        // Check No Logistics
        unset($testData['logistics_item']);
        $testData['attendee']['firstname'] = 'Joan';
        $reservation = $this->Reservations->newEntity();
        $response = $this->Booking->addReservation($reservation, 3, $testData, false);
        $this->assertNotFalse($response);

        $thirdRes = $this->Reservations->get(4, ['contain' => ['Invoices', 'LogisticItems']]);
        $this->assertTrue(preg_match('/[0-9]+\-[0-9]+\-[A-Z]{3}/', $thirdRes->reservation_number) !== 0);
        $this->assertNotEmpty($thirdRes->invoice);
        $this->assertEmpty($thirdRes->logistic_items);
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testNotifyReservation()
    {
        $response = $this->Booking->notifyReservation(1);
        $this->assertTrue($response);
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testConfirmReservation()
    {
        $response = $this->Booking->confirmReservation(1);
        $this->assertTrue($response);
    }
}
