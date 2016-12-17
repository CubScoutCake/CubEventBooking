<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LandingController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LandingController Test Case
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
    public function testUserHome()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/landing/user-home');

        $this->assertResponseOk();
    }

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testUserHomeUnauthenticatedFails()
    {
        $this->markTestIncomplete('Not implemented yet.');
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

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
