<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use App\Shell\DatabaseShell;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.roles',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.password_states',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.attendees',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/users');

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
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/users/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/users/edit/1');

        $this->assertResponseOk();
    }

    /**
     * Test Sync method
     *
     * @return void
     */
    public function testSync()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 1,
            'Auth.User.section_id' => 1,
        ]);

        $this->get('/users/sync');

        $this->assertRedirect(['controller' => 'Landing', 'action' => 'user_home']);
    }

    public function testReset()
    {
        $this->get('/users/reset');

        $this->assertResponseOk();
    }

    public function testLogin()
    {
        $this->assertEquals(1, 1);

        $this->get('/users/login');

        $this->assertResponseOk();

        $this->get('/login');

        $this->assertResponseOk();

        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $users = TableRegistry::get('Users');

        $default = $users->findByUsername('Test')->first();
        $default->password = 'TestMe';

        $users->save($default);

        $this->post(['controller' => 'Users', 'action' => 'login'], ['username' => 'Jacob', 'password' => 'TestMe']);

        $this->assertResponseOk();
    }
}
