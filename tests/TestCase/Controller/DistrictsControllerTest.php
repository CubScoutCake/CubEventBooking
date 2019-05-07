<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DistrictsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\DistrictsController Test Case
 */
class DistrictsControllerTest extends IntegrationTestCase
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

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/districts']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/districts');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/districts?page=1');

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/districts/view/1');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/districts/view/1']);
    }
}
