<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Admin\UsersController Test Case
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
    ];

    /**
     * Test index method
     *
     * @return void
     *
     * @throws
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
     *
     * @throws
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
     *
     * @throws
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
     *
     * @throws
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

    /**
     * Test Reset Method
     *
     * @return void
     *
     * @throws
     */
    public function testReset()
    {
        $this->get('/users/reset');

        $this->assertResponseOk();
    }

    /**
     * Test Login Method
     *
     * @return void
     *
     * @throws
     */
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
