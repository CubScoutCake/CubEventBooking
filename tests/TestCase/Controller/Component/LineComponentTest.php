<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\LineComponent;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\LineComponent Test Case
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 */
class LineComponentTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Allergies',
        'app.ApplicationStatuses',
        'app.Applications',
        'app.ApplicationsAttendees',
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
        'app.Sessions',
    ];

    /**
     * Test subject
     *
     * @var \App\Controller\Component\LineComponent
     */
    public $Line;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Line = new LineComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Line);

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
     * Test ParseInvoice Function
     *
     * @return void
     */
    public function testParseInvoice()
    {
        $invoices = $this->getTableLocator()->get('Invoices');

        $response = $this->Line->parseInvoice(1);
        $this->assertTrue($response);

        $invoiceA = $invoices->get(1, ['contain' => 'InvoiceItems']);

        $this->assertEquals(4, count($invoiceA->invoice_items));

        $response = $this->Line->parseInvoice(2);
        $this->assertTrue($response);

        $invoiceB = $invoices->get(2, ['contain' => 'InvoiceItems']);
        $this->assertEquals(4, count($invoiceB->invoice_items));

        $invoiceB = $invoices->get(2, ['contain' => [ 'InvoiceItems' => [ 'conditions' => ['visible' => true]]]]);
        $this->assertEquals(4, count($invoiceB->invoice_items));
    }

    /**
     * Test ParseLine Function
     *
     * @return void
     */
    public function testParseLine()
    {
        // Event 1 - Team Bookings
        $events = $this->getTableLocator()->get('Events');

        /** @var \App\Model\Entity\Event $teamBookingEvent */

        $teamBookingEvent = $events->get(2, ['contain' => 'Prices']);

        $this->assertTrue($teamBookingEvent->get('team_price'));
        foreach ($teamBookingEvent->prices as $price) {
            if ($price->item_type_id == 1) {
                $this->assertEquals(6, $price->max_number);
            }
        }

        // Team Price 1 (on / over / override)
        $response = $this->Line->parseLine(1, 1, 6);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(1, 1, 7);
        $this->assertFalse($response);
        $response = $this->Line->parseLine(1, 1, 7, true);
        $this->assertTrue($response);

        // Event 3 - Line Bookings
        $events = $this->getTableLocator()->get('Events');
        $sectionBookingEvent = $events->get(3, ['contain' => 'Prices']);

        $this->assertFalse($sectionBookingEvent->get('team_price'));

        // Cubs (on / over / override)
        $this->assertTrue($teamBookingEvent->get('team_price'));
        foreach ($teamBookingEvent->prices as $price) {
            if ($price->item_type_id == 2) {
                $this->assertEquals(5, $price->max_number);
            }
        }

        $response = $this->Line->parseLine(2, 2, 5);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 2, 6);
        $this->assertFalse($response);
        $response = $this->Line->parseLine(2, 2, 6, true);
        $this->assertTrue($response);

        // Beavers (on / over / override)
        foreach ($teamBookingEvent->prices as $price) {
            if ($price->item_type_id == 3) {
                $this->assertEquals(2, $price->max_number);
            }
        }

        $response = $this->Line->parseLine(2, 3, 2);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 3, 3);
        $this->assertFalse($response);
        $response = $this->Line->parseLine(2, 3, 3, true);
        $this->assertTrue($response);

        // Scouts (on / over / override)
        foreach ($teamBookingEvent->prices as $price) {
            if ($price->item_type_id == 4) {
                $this->assertEquals(3, $price->max_number);
            }
        }

        $response = $this->Line->parseLine(2, 4, 3);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 4, 4);
        $this->assertFalse($response);
        $response = $this->Line->parseLine(2, 4, 4, true);
        $this->assertTrue($response);

        // Explorers (on / over / override)
        foreach ($teamBookingEvent->prices as $price) {
            if ($price->item_type_id == 5) {
                $this->assertEquals(3, $price->max_number);
            }
        }

        $response = $this->Line->parseLine(2, 5, 3);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 5, 4);
        $this->assertFalse($response);
        $response = $this->Line->parseLine(2, 5, 4, true);
        $this->assertTrue($response);

        // Adults (on / over / override)
        foreach ($teamBookingEvent->prices as $price) {
            if ($price->item_type_id == 6) {
                $this->assertEquals(10, $price->max_number);
            }
        }

        $response = $this->Line->parseLine(2, 6, 10);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 6, 11);
        $this->assertFalse($response);
        $response = $this->Line->parseLine(2, 6, 11, true);
        $this->assertTrue($response);

        // Test Price & Invoice Mismatch
        $response = $this->Line->parseLine(1, 6, 1);
        $this->assertFalse($response);
    }

    /**
     * Test ParseReservation Function
     *
     * @return void
     */
    public function testParseReservation()
    {
        $this->Reservations = $this->getTableLocator()->get('Reservations');
        $reservation = $this->Reservations->get(1, ['contain' => 'Invoices.InvoiceItems']);

        $this->assertTrue($reservation->has('invoice'));

        $this->assertEquals(1, $reservation->invoice->initialvalue);
        $this->assertEquals(0, $reservation->invoice->balance);
        $this->assertEquals(0, count($reservation->invoice->invoice_items));

        $response = $this->Line->parseReservation($reservation->id);

        $reservation = $this->Reservations->get(1, ['contain' => 'Invoices.InvoiceItems']);

        $this->assertTrue($response);
//        $this->assertEquals(20, $reservation->invoice->initialvalue);
//        $this->assertEquals(19, $reservation->invoice->balance);
        $this->assertEquals(1, count($reservation->invoice->invoice_items));
    }
}
