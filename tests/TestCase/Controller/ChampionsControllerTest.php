<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ChampionsController;
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
        'app.champions',
        'app.districts',
        'app.scoutgroups',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
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

        $this->get('/champions');

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

        $this->get('/champions/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->get('/champions');

        $this->assertResponseOk();
    }
}
