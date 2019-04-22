<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\InvoiceItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\InvoiceItemsController Test Case
 */
class InvoiceItemsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test populate method
     *
     * @return void
     */
    public function testPopulate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test repopulate method
     *
     * @return void
     */
    public function testRepopulate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
