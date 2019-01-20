<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\LineComponent;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\LineComponent Test Case
 */
class LineComponentTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.allergies',
        'app.application_statuses',
        'app.applications',
        'app.applications_attendees',
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
        'app.sessions',
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

        $this->assertEquals(1, count($invoiceA->invoice_items));

        $response = $this->Line->parseInvoice(2);
        $this->assertTrue($response);

        $invoiceB = $invoices->get(2, ['contain' => 'InvoiceItems']);
        $this->assertEquals(5, count($invoiceB->invoice_items));

        $invoiceB = $invoices->get(2, ['contain' => [ 'InvoiceItems' => [ 'conditions' => ['visible' => true]]]]);
        $this->assertEquals(4, count($invoiceB->invoice_items));
    }

    public function testParseLine()
    {
        // Event 1 - Team Bookings
        $events = $this->getTableLocator()->get('Events');
        $teamBookingEvent = $events->get(2, ['contain' => 'Prices']);

        $this->assertTrue($teamBookingEvent->get('team_price'));
        $this->assertEquals(6, $teamBookingEvent->prices[0]->max_number);

        // Team Price 1 (on / over)
        $response = $this->Line->parseLine(1, 1, 6);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(1, 1, 7);
        $this->assertFalse($response);

        // Event 3 - Line Bookings
        $events = $this->getTableLocator()->get('Events');
        $sectionBookingEvent = $events->get(3, ['contain' => 'Prices']);

        $this->assertFalse($sectionBookingEvent->get('team_price'));

        // Cubs (on / over)
        $this->assertEquals(5, $sectionBookingEvent->prices[4]->max_number);

        $response = $this->Line->parseLine(2, 2, 5);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 2, 6);
        $this->assertFalse($response);

        // Beavers (on / over)
        $this->assertEquals(2, $sectionBookingEvent->prices[3]->max_number);

        $response = $this->Line->parseLine(2, 3, 2);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 3, 3);
        $this->assertFalse($response);

        // Scouts (on / over)
        $this->assertEquals(3, $sectionBookingEvent->prices[2]->max_number);

        $response = $this->Line->parseLine(2, 4, 3);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 4, 4);
        $this->assertFalse($response);

        // Explorers (on / over)
        $this->assertEquals(3, $sectionBookingEvent->prices[1]->max_number);

        $response = $this->Line->parseLine(2, 5, 3);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 5, 4);
        $this->assertFalse($response);

        // Adults (on / over)
        $this->assertEquals(10, $sectionBookingEvent->prices[0]->max_number);

        $response = $this->Line->parseLine(2, 6, 10);
        $this->assertTrue($response);
        $response = $this->Line->parseLine(2, 6, 11);
        $this->assertFalse($response);

        // Test Price & Invoice Mismatch
        $response = $this->Line->parseLine(1, 6, 1);
        $this->assertFalse($response);
    }
}
