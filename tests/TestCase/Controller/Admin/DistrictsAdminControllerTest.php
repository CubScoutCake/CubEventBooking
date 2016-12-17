<?php
namespace App\Test\TestCase\Admin\Controller;

use App\Controller\Admin\DistrictsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin/DistrictsController Test Case
 */
class DistrictsAdminControllerTest extends IntegrationTestCase
{

    public $fixtures = [
        'app.districts'
    ];

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/admin/districts');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testIndexUnauthorisedFails()
    {
        $this->session(['Auth.User.authrole' => 'user']);

        $this->get('/admin/districts');

        $this->assertResponseSuccess();

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'user-home']);
    }



    public function testAddUnauthorisedFails()
    {
        $this->session(['Auth.User.authrole' => 'user']);

        $this->get('/admin/districts/add');

        $this->assertResponseSuccess();

        $this->assertRedirect(['prefix' => false, 'controller' => 'Landing', 'action' => 'user-home']);
    }

    public function testAddAuthorisedLoads()
    {
        $this->session(['Auth.User.authrole' => 'admin']);

        $this->get('/admin/districts/add');

        $this->assertResponseSuccess();
    }

}
