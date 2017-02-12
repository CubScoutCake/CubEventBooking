<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AttendeesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\AttendeesController Test Case
 */
class AttendeesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendees',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.events',
        'app.applications_attendees',
        'app.sections',
        'app.auth_roles',
        'app.section_types',
        'app.settings',
        'app.settingtypes',
        'app.discounts',
        'app.event_types',
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
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/attendees');

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

        $this->get('/attendees/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test adult method
     *
     * @return void
     */
    public function testAdult()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/attendees/adult');

        $this->assertResponseOk();
    }

    /**
     * Test cub method
     *
     * @return void
     */
    public function testCub()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/attendees/cub');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/attendees/edit/1');

        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/attendees/delete/1');

        $this->assertRedirect();
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorized()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/attendees/edit/1');

        $this->assertResponseOk();

        $this->session([
            'Auth.User.id' => 2,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/attendees/edit/1');

        $this->assertRedirect();
    }
}
