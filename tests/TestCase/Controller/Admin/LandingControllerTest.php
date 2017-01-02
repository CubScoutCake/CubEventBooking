<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\LandingController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\Admin/LandingController Test Case
 */
class LandingAdminControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.settingtypes',
        'app.settings',
        'app.districts',
        'app.scoutgroups',
        'app.roles',
        'app.users',
        'app.applications',
        'app.events',
        'app.discounts',
        'app.auth_roles',
        'app.sections',
        'app.section_types',
    ];

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testUserHome()
    {
        $this->markTestSkipped('To be Fixed');

        $this->session(['Auth.User.id' => 1]);

        $this->get('/landing/user-home');

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
    public function testUserHomeUnauthorisedFails()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.authrole' => 'user'
        ]);

        $this->get('/admin/landing/admin-home');

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'userHome']);

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.authrole' => 'champion'
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
