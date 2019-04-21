<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\ReservationStatusesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SuperUser\ReservationStatusesController Test Case
 */
class ReservationStatusesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
        'app.notification_types',
        'app.notifications',
        'app.application_statuses',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.event_statuses',
        'app.discounts',
        'app.events',
        'app.prices',
        'app.applications',
        'app.task_types',
        'app.tasks',
        'app.attendees',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.reservation_statuses',
        'app.reservations',
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
