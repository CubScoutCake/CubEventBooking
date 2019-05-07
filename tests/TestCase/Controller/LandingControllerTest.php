<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LandingController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\LandingController Test Case
 */
class LandingControllerTest extends IntegrationTestCase
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
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.logistics',
        'app.logistic_items',
        'app.email_sends',
        'app.tokens',
        'app.email_response_types',
        'app.email_responses',
        'app.champions',
        'app.sessions',
    ];

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testUserHome()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get(['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]);

        $this->assertResponseOk();
    }

    public function testUserHomeUnauthenticatedFails()
    {
        // No session data set.
        $this->get(['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]);

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/landing/user-home']);

        $this->session([
            'Auth.User.auth_role_id' => 4,
            'Auth.User.id' => 1,
        ]);

        $this->get(['controller' => 'Payments', 'action' => 'index', 'prefix' => false]);

        $this->assertRedirect();
    }

    /**
     * Test welcome method
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->get('/');

        $this->assertResponseOk();
    }
}
