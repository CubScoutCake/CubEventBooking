<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\AuthRolesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SuperUser\AuthRolesController Test Case
 */
class AuthRolesControllerTest extends IntegrationTestCase
{

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
        'app.notification_types',
        'app.notifications',
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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'AuthRoles',
            'action' => 'index',
            'prefix' => 'super_user',
        ]);

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
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'AuthRoles',
            'action' => 'view',
            'prefix' => 'super_user',
            1
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     *
     * @throws
     */
    public function testAdd()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'AuthRoles',
            'action' => 'add',
            'prefix' => 'super_user'
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'AuthRoles',
            'action' => 'add',
            'prefix' => 'super_user',
        ], [
            'auth_role' => 'Llama',
            'admin_access' => true,
            'champion_access' => false,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The auth role has been saved.');
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
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'AuthRoles',
            'action' => 'edit',
            'prefix' => 'super_user',
            1
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'AuthRoles',
            'action' => 'edit',
            'prefix' => 'super_user',
            1
        ], [
            'auth_role' => 'User',
            'admin_access' => true,
            'champion_access' => false,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The auth role has been saved.');
    }

    /**
     * Test delete method
     *
     * @return void
     *
     * @throws
     */
    public function testDelete()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'AuthRoles',
            'action' => 'add',
            'prefix' => 'super_user',
        ], [
            'auth_role' => 'Llama',
            'admin_access' => true,
            'champion_access' => false,
            'super_user' => false,
            'auth' => 1,
            'parent_access' => false,
            'user_access' => true,
            'section_limited' => true
        ]);

        $this->assertRedirect();

        $this->post([
            'controller' => 'AuthRoles',
            'action' => 'delete',
            'prefix' => 'super_user',
            6
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The auth role has been deleted.');
    }
}
