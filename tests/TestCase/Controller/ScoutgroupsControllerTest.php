<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ScoutgroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\ScoutgroupsController Test Case
 */
class ScoutgroupsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */

    public $fixtures = [
        'app.scoutgroups',
        'app.districts',
        'app.roles',
        'app.users',
        'app.auth_roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/scoutgroups');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/scoutgroups');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/scoutgroups/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
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
            'Auth.User.authrole' => 'user'
        ]);

        $this->get('/scoutgroups/view/1');

        $this->assertResponseOk();
    }
}
