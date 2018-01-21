<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\DistrictsController;
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
        'app.districts',
        'app.scoutgroups',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.users',
        'app.sections',
        'app.section_types',
        'app.roles',
        'app.password_states',
    ];

    public function testIndexUnauthenticatedFails()
    {
        $this->markTestIncomplete('SuperUser');

        // No session data set.
        $this->get('/super_user/districts');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
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

        $this->get('/super_user/districts');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/super_user/districts?page=1');

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

        $this->get('/super_user/districts/view/1');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        $this->markTestIncomplete('SuperUser');

        // No session data set.
        $this->get('/super_user/districts/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }
}
