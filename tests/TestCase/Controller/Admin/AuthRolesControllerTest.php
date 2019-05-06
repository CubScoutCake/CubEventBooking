<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\AuthRolesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\AuthRolesController Test Case
 */
class AuthRolesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AuthRoles'
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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/auth-roles');

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

        $this->get('/admin/auth-roles/view/1');

        $this->assertResponseOk();
    }
}
