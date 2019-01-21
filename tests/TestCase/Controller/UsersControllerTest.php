<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/users');

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
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/users/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/users/edit/1');

        $this->assertResponseOk();
    }

    /**
     * Test Sync method
     *
     * @return void
     */
    public function testSync()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1,
            'Auth.User.section_id' => 1,
        ]);

        $this->get('/users/sync');

        $this->assertRedirect(['controller' => 'Landing', 'action' => 'user_home']);
    }

    public function testReset()
    {
        $this->get('/users/reset');

        $this->assertResponseOk();
    }

    public function testLogin()
    {
        $this->assertEquals(1, 1);

        $this->get('/users/login');

        $this->assertResponseOk();

        $this->get('/login');

        $this->assertResponseOk();

        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $users = TableRegistry::get('Users');

        $default = $users->findByUsername('Test')->first();
        $default->password = 'TestMe';

        $users->save($default);

        $this->post(['controller' => 'Users', 'action' => 'login'], ['username' => 'Jacob', 'password' => 'TestMe']);

        $this->assertResponseOk();
    }
}
