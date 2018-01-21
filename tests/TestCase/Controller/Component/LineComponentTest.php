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
		'app.event_types',
		'app.events',
		'app.settings',
		'app.setting_types',
		'app.discounts',
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
		'app.invoices',
		'app.invoice_items',
		'app.item_types',
		'app.prices',
		'app.notes',
		'app.payments',
		'app.invoices_payments',
		'app.logistic_items',
		'app.logistics',
		'app.parameters',
		'app.parameter_sets',
		'app.params',
		'app.applications_attendees',
		'app.allergies',
		'app.attendees_allergies',
		'app.auth_roles',
		'app.notifications',
		'app.notification_types'
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
	    $invoices = TableRegistry::get('Invoices');

    	$response = $this->Line->parseInvoice(1);
    	$this->assertTrue($response);

    	$invoiceA = $invoices->get(1, ['contain' => 'InvoiceItems']);

    	debug($invoiceA->invoice_items);
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

	    // Team Price 1 (on / over)
    	$response = $this->Line->parseLine(1,1,1);
    	$this->assertTrue($response);
	    $response = $this->Line->parseLine(1,1,2);
	    $this->assertFalse($response);

	    // Team Price 2 (on / over)
	    $response = $this->Line->parseLine(1,5,1);
	    $this->assertTrue($response);
	    $response = $this->Line->parseLine(1,5,2);
	    $this->assertFalse($response);

	    // Event 3 - Line Bookings

		// Cubs (on / over)
	    $response = $this->Line->parseLine(2,2,5);
	    $this->assertTrue($response);
	    $response = $this->Line->parseLine(2,2,8);
	    $this->assertFalse($response);

	    // Beavers (on / over)
	    $response = $this->Line->parseLine(2,3,2);
	    $this->assertTrue($response);
	    $response = $this->Line->parseLine(2,3,4);
	    $this->assertFalse($response);

	    // Scouts (on / over)
	    $response = $this->Line->parseLine(2,4,3);
	    $this->assertTrue($response);
	    $response = $this->Line->parseLine(2,4,4);
	    $this->assertFalse($response);

	    // Explorers (on / over)
	    $response = $this->Line->parseLine(2,6,3);
	    $this->assertTrue($response);
	    $response = $this->Line->parseLine(2,6,4);
	    $this->assertFalse($response);

	    // Adults (on / over)
	    $response = $this->Line->parseLine(2,7,10);
	    $this->assertTrue($response);
	    $response = $this->Line->parseLine(2,7,12);
	    $this->assertFalse($response);

	    // Test Price & Invoice Mismatch
	    $response = $this->Line->parseLine(1,7,1);
	    $this->assertFalse($response);
    }
}
