<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\ApplicationStatusesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ApplicationStatusesController Test Case
 */
class ApplicationStatusesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applications', 'app.application_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.roles',
        'app.password_states',
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.users',
        'app.events', 'app.event_statuses',
        'app.event_types',
        'app.auth_roles',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
