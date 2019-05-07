<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PaymentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\PaymentsController Test Case
 */
class PaymentsControllerTest extends IntegrationTestCase
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
    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/Payments');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/Payments']);
    }

    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/payments');

        $this->assertResponseOk();
    }
}
