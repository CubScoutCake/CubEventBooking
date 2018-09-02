<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EventsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EventsController Test Case
 */
class EventsControllerTest extends IntegrationTestCase
{

    public $fixtures = [
        'app.event_types',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.auth_roles',
        'app.password_states',
        'app.notifications',
        'app.notification_types',
        'app.applications', 'app.application_statuses',
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

        $this->get('/events');

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

        $this->get('/events/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testBookGet()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/events/book/1');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testBookPost()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/events/book/1', ['section' => 1, 'non_section' => 2, 'leaders' => 3]);

        $this->assertRedirect(['controller' => 'Applications', 'action' => 'simple_book', 1, 1, 2, 3]);
    }
}
