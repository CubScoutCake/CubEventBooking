<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TasksController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TasksController Test Case
 */
class TasksControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
        'app.Notes',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.Logistics',
        'app.LogisticItems',
        'app.EmailSends',
        'app.Tokens',
        'app.EmailResponseTypes',
        'app.EmailResponses',
        'app.Champions',
        'app.Sessions',
    ];

    /**
     * Test index method
     *
     * @throws
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'controller' => 'Tasks',
            'action' => 'index',
            'prefix' => false,
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @throws
     *
     * @return void
     */
    public function testView()
    {
        // Correct View Access
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'controller' => 'Tasks',
            'action' => 'view',
            'prefix' => false,
            1
        ]);
        $this->assertResponseOk();

        // Unauthorised Redirect (Not own Task)
        $this->session([
            'Auth.User.id' => 2,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'controller' => 'Tasks',
            'action' => 'view',
            'prefix' => false,
            1
        ]);
        $this->assertRedirect();
    }
}
