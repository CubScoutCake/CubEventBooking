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

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/roles');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/roles']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexAuthorised()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

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

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/roles/view/1');

        $this->assertResponseOk();
    }
}
