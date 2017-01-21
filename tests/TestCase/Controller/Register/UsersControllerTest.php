<?php
namespace App\Test\TestCase\Controller\Register;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.roles',
        'app.auth_roles',
        'app.sections',
        'app.section_types',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.applications',
        'app.allergies',
        'app.events',
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
    public function testRegisterSectionRedirect()
    {
        $this->get(['prefix' => 'register', 'controller' => 'Users', 'action' => 'register']);

        $this->assertRedirect(['prefix' => 'register', 'controller' => 'Sections', 'action' => 'select']);
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
