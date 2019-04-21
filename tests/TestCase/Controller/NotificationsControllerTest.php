<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotificationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\NotificationsController Test Case
 */
class NotificationsControllerTest extends IntegrationTestCase
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
        'app.invoices',
        'app.invoice_items',
        'app.payments',
        'app.invoices_payments',
        'app.notes',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.logistics',
        'app.logistic_items',
        'app.email_sends',
        'app.tokens',
        'app.email_response_types',
        'app.email_responses',
        'app.champions',
        'app.sessions',
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

        $this->get('/notifications');

        $this->assertResponseOk();
    }

    /**
     * Test unread method
     *
     * @return void
     */
    public function testUnread()
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
     * Test welcome method
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validate method
     *
     * @return void
     */
    public function testValidate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test new_logistic method
     *
     * @return void
     */
    public function testNewLogistic()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test new_reset method
     *
     * @return void
     */
    public function testNewReset()
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

    /**
     * Test beforeFilter method
     *
     * @return void
     */
    public function testBeforeFilter()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorized()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getMailer method
     *
     * @return void
     */
    public function testGetMailer()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
