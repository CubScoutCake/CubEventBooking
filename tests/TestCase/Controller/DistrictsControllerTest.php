<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DistrictsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\DistrictsController Test Case
 */
class DistrictsControllerTest extends IntegrationTestCase
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

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/districts']);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/districts');

        $this->assertResponseOk();
    }

    public function testIndexQueryData()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/districts?page=1');

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
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/districts/view/1');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/districts/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/districts/view/1']);
    }
}
