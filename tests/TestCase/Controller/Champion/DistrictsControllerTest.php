<?php
namespace App\Test\TestCase\Controller\Champion;

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
        'app.sections',
        'app.section_types',
        'app.users',
        'app.auth_roles',
        'app.password_states',
        'app.roles',
        'app.notifications',
        'app.notification_types',
        'app.champions',
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/champion/districts');

        $this->assertRedirect(['controller' => 'Users', 'prefix' => false, 'action' => 'login', 'redirect' => '/champion/districts']);
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

        $this->get('/champion/districts');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/champion/districts?page=1');

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

        $this->get('/champion/districts/view/1');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.

        $this->get('/champion/districts/view/1');

        $this->assertRedirect(['controller' => 'Users', 'prefix' => false, 'action' => 'login', 'redirect' => '/champion/districts/view/1']);
    }
}
