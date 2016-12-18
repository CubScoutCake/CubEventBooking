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
    'app.scoutgroups',
    'app.districts',
    'app.roles',
    'app.users',
    'app.auth_roles',
    'app.attendees'
    ];

    public function testIndexUnauthenticatedFails()
    {
    // No session data set.
    $this->get('/admin/scoutgroups');

    $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthorised()
    {
        $this->markTestSkipped('Authorisation Issue.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.authrole' => 'user'
        ]);

        $this->get('/admin/scoutgroups');

        $this->assertRedirect(['controller' => 'Landing', 'action' => 'user-home']);
    }

    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.authrole' => 'admin'
        ]);

        $this->get('/admin/scoutgroups');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/admin/scoutgroups/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testViewUnauthorised()
    {
        $this->markTestSkipped('Authorisation Issue.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.authrole' => 'user'
        ]);

        $this->get('/admin/scoutgroups/view/1');

        $this->assertRedirect(['controller' => 'Landing', 'action' => 'user-home']);
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
            'Auth.User.authrole' => 'admin'
        ]);

        $this->get('/admin/scoutgroups/view/1');

        $this->assertResponseOk();
    }
}
