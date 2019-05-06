<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\ScoutgroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\ScoutgroupsController Test Case
 */
class ScoutgroupsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */

    public $fixtures = [
        'app.Scoutgroups',
        'app.Districts',
        'app.Roles',
        'app.Users',
        'app.AuthRoles',
        'app.Attendees',
        'app.AuthRoles',
        'app.PasswordStates',
        'app.Sections',
        'app.SectionTypes',
        'app.Notifications',
        'app.NotificationTypes',
    ];

    public function testIndexUnauthenticatedFails()
    {
    // No session data set.
        $this->get('/admin/scoutgroups');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false, 'redirect' => '/admin/scoutgroups']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthorised()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/admin/scoutgroups');

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'user-home']);
    }

    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/scoutgroups');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/admin/scoutgroups/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false, 'redirect' => '/admin/scoutgroups/view/1']);
    }

    public function testViewUnauthorised()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/admin/scoutgroups/view/1');

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'user_home']);
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

        $this->get('/admin/scoutgroups/view/1');

        $this->assertResponseOk();
    }
}
