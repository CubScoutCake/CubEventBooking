<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TasksController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TasksController Test Case
 */
class TasksControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TaskTypes',
        'app.Tasks',
        'app.Users',
        'app.AuthRoles',
        'app.PasswordStates',
        'app.Roles',
        'app.Districts',
        'app.Scoutgroups',
        'app.Sections',
        'app.SectionTypes',
    ];

    /**
     * Test index method
     *
     * @throws
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'controller' => 'Tasks',
            'action' => 'index',
            'prefix' => false,
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @throws
     *
     * @return void
     */
    public function testView()
    {
        // Correct View Access
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'controller' => 'Tasks',
            'action' => 'view',
            'prefix' => false,
            1
        ]);
        $this->assertResponseOk();

        // Unauthorised Redirect (Not own Task)
        $this->session([
            'Auth.User.id' => 2,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'controller' => 'Tasks',
            'action' => 'view',
            'prefix' => false,
            1
        ]);
        $this->assertRedirect();
    }
}
