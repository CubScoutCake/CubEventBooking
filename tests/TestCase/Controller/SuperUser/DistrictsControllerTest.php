<?php
namespace App\Test\TestCase\Controller;

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
        'app.scoutgroups'
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts');

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

        $this->get('/districts');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/districts?page=1');

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/districts/view/1');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }
}
