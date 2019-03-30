<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\LogisticItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\LogisticItemsController Test Case
 */
class LogisticItemsControllerTest extends IntegrationTestCase
{

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
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
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
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
