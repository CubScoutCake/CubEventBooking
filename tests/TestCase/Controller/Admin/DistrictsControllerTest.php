<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\DistrictsController;
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
        'app.Districts',
        'app.Scoutgroups',
        'app.Users',
        'app.PasswordStates',
        'app.Sections',
        'app.Notifications',
        'app.notificationtypes',
        'app.Roles',
        'app.SectionTypes',
        'app.AuthRoles',
        'app.Applications', 'app.ApplicationStatuses',
        'app.Events', 'app.EventStatuses',
        'app.Settings',
        'app.SettingTypes',
        'app.Discounts',
        'app.EventTypes',
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts');

        $this->assertRedirect('/login?redirect=%2Fdistricts');
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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/districts');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/districts?page=1');

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

        $this->get('/admin/districts/view/1');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/admin/districts/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false, 'redirect' => '/admin/districts/view/1']);
    }
}
