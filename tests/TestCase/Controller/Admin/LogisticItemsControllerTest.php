<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\LogisticItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\LogisticItemsController Test Case
 */
class LogisticItemsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Prices',
        'app.ItemTypes',
        'app.InvoiceItems',
        'app.Invoices',
        'app.Users',
        'app.Roles',
        'app.PasswordStates',
        'app.Attendees',
        'app.Sections',
        'app.SectionTypes',
        'app.Scoutgroups',
        'app.Districts',
        'app.Champions',
        'app.Applications', 'app.ApplicationStatuses',
        'app.Events', 'app.EventStatuses',
        'app.Settings',
        'app.SettingTypes',
        'app.Discounts',
        'app.Logistics',
        'app.Parameters',
        'app.ParameterSets',
        'app.Params',
        'app.LogisticItems',
        'app.Notes',
        'app.ApplicationsAttendees',
        'app.Allergies',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Notifications',
        'app.NotificationTypes',
        'app.Payments',
        'app.InvoicesPayments',
        'app.EventTypes',
        'app.Reservations',
        'app.ReservationStatuses',
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
