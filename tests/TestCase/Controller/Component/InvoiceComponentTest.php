<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\InvoiceComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\InvoiceComponent Test Case
 */
class InvoiceComponentTest extends TestCase
{

    public $fixtures = [
        'app.event_types',
        'app.events',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.users',
        'app.roles',
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
     * @var \App\Controller\Component\InvoiceComponent
     */
    public $Invoice;

    /**
     * Test subject
     *
     * @var \App\Controller\Component\InvoiceComponent
     */
    public $component = null;

    /**
     * Test subject
     *
     * @var \App\Controller\*
     */
    public $controller = null;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Invoice = new InvoiceComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Invoice);

        parent::tearDown();
    }

    /**
     * Test populateInvoice method
     *
     * @return void
     */
    public function testPopulateInvoice()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getLines method
     *
     * @return void
     */
    public function testGetLines()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test createLine method
     *
     * @return void
     */
    public function testCreateLine()
    {
        $this->assertTrue($this->Invoice->createLine(1, 1, 1));

        $this->assertTrue($this->Invoice->createLine(1, 2, 1));
    }
}
