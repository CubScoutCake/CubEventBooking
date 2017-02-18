<?php
namespace App\Test\TestCase\Controller\SuperUser;

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
     */

    public $fixtures = [
        'app.settings',
        'app.districts',
        'app.scoutgroups',
        'app.roles',
        'app.users',
        'app.auth_roles',
        'app.sections',
        'app.section_types',
        'app.setting_types',
    ];

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testSuperUserHome()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/super_user');

        $this->assertResponseOk();
    }

    public function testUserHomeUnauthenticatedFails()
    {
        $this->markTestIncomplete('SuperUser');

        // No session data set.
        $this->get('/champion/landing/champion-home');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
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
