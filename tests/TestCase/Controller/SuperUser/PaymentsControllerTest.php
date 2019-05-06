<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\PaymentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\PaymentsController Test Case
 */
class PaymentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Districts',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.PasswordStates',
        'app.AuthRoles',
        'app.ItemTypes',
        'app.Roles',
        'app.Users',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ApplicationStatuses',
        'app.SettingTypes',
        'app.Settings',
        'app.EventTypes',
        'app.EventStatuses',
        'app.Discounts',
        'app.Events',
        'app.Prices',
        'app.Applications',
        'app.TaskTypes',
        'app.Tasks',
        'app.Attendees',
        'app.ApplicationsAttendees',
        'app.Allergies',
        'app.AttendeesAllergies',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Invoices',
        'app.InvoiceItems',
        'app.Payments',
        'app.InvoicesPayments',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthenticatedFails()
    {
        $this->markTestIncomplete('SuperUser');

        // No session data set.
        $this->get('/Payments');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*$this->session(['Auth.User.id' => 1]);

        $this->get('/payments');

        $this->assertResponseOk();*/
    }
}
