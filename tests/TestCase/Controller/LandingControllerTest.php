<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Admin\LandingController Test Case
 */
class LandingControllerTest extends TestCase
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
        'app.params',
        'app.Logistics',
        'app.LogisticItems',
        'app.EmailSends',
        'app.Tokens',
        'app.EmailResponseTypes',
        'app.EmailResponses',
    ];

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testUserHome()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get(['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]);

        $this->assertResponseOk();
    }

    public function testUserHomeUnauthenticatedFails()
    {
        // No session data set.
        $this->get(['controller' => 'Landing', 'action' => 'user_home', 'prefix' => false]);

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/landing/user-home']);

        $this->session([
            'Auth.User.auth_role_id' => 4,
            'Auth.User.id' => 1,
        ]);

        $this->get(['controller' => 'Payments', 'action' => 'index', 'prefix' => false]);

        $this->assertRedirect();
    }

    /**
     * Test welcome method
     *
     * @return void
     */
    public function testWelcome()
    {
        $this->get('/');

        $this->assertResponseOk();
    }
}
