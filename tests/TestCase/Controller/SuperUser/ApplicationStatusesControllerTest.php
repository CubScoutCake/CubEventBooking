<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\ApplicationStatusesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SuperUser\ApplicationStatusesController Test Case
 */
class ApplicationStatusesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Sessions',
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
            'controller' => 'ApplicationStatuses',
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
            'controller' => 'ApplicationStatuses',
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
            'controller' => 'ApplicationStatuses',
            'action' => 'add',
            'prefix' => 'super_user',
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'ApplicationStatuses',
            'action' => 'add',
            'prefix' => 'super_user',
        ], [
            'application_status' => 'New Application',
            'active' => true,
            'no_money' => false,
            'reserved' => true,
            'attendees_added' => false,
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The application status has been saved.');
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
            'controller' => 'ApplicationStatuses',
            'action' => 'edit',
            'prefix' => 'super_user',
            1
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'ApplicationStatuses',
            'action' => 'edit',
            'prefix' => 'super_user',
            1
        ], [
            'application_status' => 'Old Application',
            'active' => false,
            'no_money' => false,
            'reserved' => false,
            'attendees_added' => false,
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The application status has been saved.');
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

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        // Post something to delete
        $this->post([
            'controller' => 'ApplicationStatuses',
            'action' => 'add',
            'prefix' => 'super_user',
        ], [
            'application_status' => 'New Application',
            'active' => true,
            'no_money' => false,
            'reserved' => true,
            'attendees_added' => false,
        ]);

        $this->assertRedirect();

        $this->post([
            'controller' => 'ApplicationStatuses',
            'action' => 'delete',
            'prefix' => 'super_user',
            2
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The application status has been deleted.');
    }
}
