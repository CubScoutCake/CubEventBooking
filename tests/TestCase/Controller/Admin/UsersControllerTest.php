<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\UsersController;
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2,
            'Auth.User.section_id' => 1
        ]);

        $this->get(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);

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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/users/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/users/add');

        $this->assertResponseOk();

        // Post function

        $data = [
            'role_id' => 1,
            'firstname' => 'Joe',
            'lastname' => 'Bloggs',
            'email' => 'joe.bloggs@somewhere.com',
            'username' => 'ThisUser',
            'password' => 'SuperSecure',
            'phone' => '01462',
            'address_1' => 'Here is',
            'address_2' => 'The Way',
            'city' => 'to',
            'membership_number' => 8298325,
            'county' => 'Ammarillo',
            'postcode' => 'GO8 0FK',
            'section_id' => 1,
            'auth_role_id' => 1,
        ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/admin/users/add', $data);

        //$this->assertRedirect();
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
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/users/sync/1');

        $this->assertRedirect();
    }

    /**
     * Test SyncAll method
     *
     * @return void
     */
    public function testSyncAll()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/users/sync-all');

        $this->assertRedirect();
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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/users/edit/1');

        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/admin/users/delete/1');

        $this->assertRedirect();
    }
}
