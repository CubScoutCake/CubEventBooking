<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ScoutgroupsController;
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
        'app.Districts',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.PasswordStates',
        'app.AuthRoles',
        'app.ItemTypes',
        'app.Roles',
        'app.Users',
        'app.NotificationTypes',
        'app.Notifications',
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/scoutgroups');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/scoutgroups']);
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

        $this->get('/scoutgroups');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/scoutgroups/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/scoutgroups/view/1']);
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestSkipped('Need to associate Scoutgroups to Sections');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/scoutgroups/view/1');

        $this->assertResponseOk();
    }
}
