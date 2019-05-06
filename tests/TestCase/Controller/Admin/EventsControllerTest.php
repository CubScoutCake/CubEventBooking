<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\EventsController;
use Cake\TestSuite\IntegrationTestCase;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * App\Admin\EventsController Test Case
 */
class EventsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Allergies',
        'app.ApplicationStatuses',
        'app.Applications',
        'app.ApplicationsAttendees',
        'app.Attendees',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Champions',
        'app.Discounts',
        'app.Districts',
        'app.EmailResponseTypes',
        'app.EmailResponses',
        'app.EmailSends',
        'app.EventStatuses',
        'app.EventTypes',
        'app.Events',
        'app.InvoiceItems',
        'app.Invoices',
        'app.InvoicesPayments',
        'app.ItemTypes',
        'app.LogisticItems',
        'app.Logistics',
        'app.Notes',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.PasswordStates',
        'app.Payments',
        'app.Prices',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Roles',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.SettingTypes',
        'app.Settings',
        'app.Users',
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

        $this->get(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'index']);

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

        $this->get(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'view', 2]);

        $this->assertResponseOk();
    }

    /**
     * Test fullView method
     *
     * @return void
     *
     * @throws
     */
    public function testAdd()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
            'Auth.User.section_id' => 1,
        ]);

        $this->get('/admin/events/add');

        $this->assertResponseOk();

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'add'], [
            'name' => 'Cyclocross',
            'full_name' => 'County Cub Cyclocross',
            'event_type_id' => 1,
            'section_type_id' => 1,
            'start_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'opening_date' => [
                'year' => 2018,
                'month' => 01,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'end_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'closing_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'live' => 1,
            'new_apps' => 1,
            'allow_reductions' => 0,
            'invoices_locked' => 0,
            'location' => 'Well End',
            'intro_text' => 'Jacob',
            'tagline_text' => 'This',
            'logo' => '/Monkey.png',
            'admin_user_id' => 1,
            'max' => 1,
            'max_apps' => '2',
            'max_section' => null,
            'discount_id' => null,
        ]);

        $this->assertRedirect();
    }

    /**
     * Test fullView method
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

        $this->get('/admin/events/edit/2');

        $this->assertResponseOk();
    }

    /**
     * Test fullView method
     *
     * @return void
     *
     * @throws
     */
    public function testPrices()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'prices', 2]);

        $this->assertResponseOk();
    }
}
