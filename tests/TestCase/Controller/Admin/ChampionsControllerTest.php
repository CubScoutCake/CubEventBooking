<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\ChampionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\ChampionsController Test Case
 */
class ChampionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Champions',
        'app.Districts',
        'app.Scoutgroups',
        'app.Users',
        'app.PasswordStates',
        'app.Roles',
        'app.AuthRoles',
        'app.Sections',
        'app.SectionTypes',
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

        $this->get('/admin/champions');

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

        $this->get('/admin/users/edit/1');

        $this->assertResponseOk();
    }
}
