<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\Admin/LandingController Test Case
 */
class LandingControllerTest extends IntegrationTestCase
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

    ];

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testAdminHome()
    {
        $this->session(['Auth.User.id' => 1,
                        'Auth.User.auth_role_id' => 2]);

        $this->get('/admin/landing/admin-home');

        $this->assertResponseOk();
    }

    /**
     * Test userHome fails to load if unauthenticated.
     *
     * @return void
     */
    public function testUserHomeUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/admin/landing/admin-home');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false, 'redirect' => '/admin/landing/admin-home']);
    }

    /**
     * Test userHome fails to load if unauthenticated.
     *
     * @return void
     */
    public function testAdminHomeUnauthorisedFails()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/admin/landing/admin-home');

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'userHome']);

        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/admin/landing/admin-home');

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'userHome']);
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
