<?php
namespace App\Test\TestCase\Controller\Champion;

use App\Controller\LandingController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\LandingController Test Case
 */
class LandingControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     *

    public $fixtures = [
    'app.settings',
    'app.districts',
    'app.scoutgroups',
    'app.roles',
    'app.users'
    ];*/

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testChampionHome()
    {
        $this->markTestSkipped('Issue with Auth Roles');
        $this->session([
           'Auth.User.id' => 3,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/champion/landing/champion-home');

        $this->assertResponseOk();
    }

    public function testUserHomeUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/landing/user-home');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/landing/user-home']);
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
