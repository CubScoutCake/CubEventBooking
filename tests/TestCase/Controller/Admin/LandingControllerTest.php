<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\LandingController;
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
        'app.setting_types',
        'app.settings',
        'app.districts',
        'app.scoutgroups',
        'app.roles',
        'app.users',
        'app.applications',
        'app.events',
        'app.discounts',
        'app.invoices',
        'app.auth_roles',
        'app.sections',
        'app.section_types',
        'app.notes',
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

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
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
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/admin/landing/admin-home');

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'userHome']);

        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
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
