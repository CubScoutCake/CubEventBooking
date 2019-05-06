<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\TaskTypesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SuperUser\TaskTypesController Test Case
 */
class TaskTypesControllerTest extends TestCase
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
     * @return void
     *
     * @throws
     */
    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'TaskTypes',
            'action' => 'index',
            'prefix' => 'super_user',
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     *
     * @throws
     */
    public function testView()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'TaskTypes',
            'action' => 'view',
            'prefix' => 'super_user',
            1
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     *
     * @throws
     */
    public function testAdd()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'TaskTypes',
            'action' => 'add',
            'prefix' => 'super_user',
        ]);

        $this->assertResponseOk();

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'TaskTypes',
            'action' => 'add',
            'prefix' => 'super_user',
        ], [
            'task_type' => 'Attendee Clean',
            'shared_type' => '0',
            'type_icon' => 'users',
            'type_code' => 'ATC',
            'task_requirement' => 'Please review the attendees you have in the system and remove their details if they are no longer in your section.',
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The task type has been saved.');
    }

    /**
     * Test edit method
     *
     * @return void
     *
     * @throws
     */
    public function testEdit()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'controller' => 'TaskTypes',
            'action' => 'edit',
            'prefix' => 'super_user',
            1
        ]);

        $this->assertResponseOk();

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'TaskTypes',
            'action' => 'edit',
            'prefix' => 'super_user',
            1
        ], [
            'task_type' => 'Attendee Clean',
            'shared_type' => '0',
            'type_icon' => 'users',
            'type_code' => 'ATC',
            'task_requirement' => 'Please review the attendees you have in the system and remove their details if they are no longer in your section.',
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The task type has been saved.');
    }

    /**
     * Test delete method
     *
     * @return void
     *
     * @throws
     */
    public function testDelete()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'TaskTypes',
            'action' => 'delete',
            'prefix' => 'super_user',
            2
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The task type has been deleted.');
    }
}
