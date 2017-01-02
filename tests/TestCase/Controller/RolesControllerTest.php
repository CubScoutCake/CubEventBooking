<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RolesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\RolesController Test Case
 */
class RolesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */

    public $fixtures = [
        'app.roles'
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/roles');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexAuthorised()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/roles');

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestSkipped('Need to associate Scoutgroups to Sections');

        $this->session(['Auth.User.id' => 1]);

        $this->get('/roles/view/1');

        $this->assertResponseOk();
    }
}
