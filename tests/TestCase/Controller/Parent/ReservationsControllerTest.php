<?php
namespace App\Test\TestCase\Controller\Parent;

use App\Controller\Parent\ReservationsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Parent\ReservationsController Test Case
 */
class ReservationsControllerTest extends TestCase
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
    public function testEvents()
    {
        $this->get([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'events'
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
        $this->get([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'view',
            1
        ]);

        $this->assertRedirect();

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 4
        ]);

        $this->get([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'view',
            1
        ]);

        $this->assertResponseOk();

        $this->session([
            'Auth.User.id' => 2,
            'Auth.User.auth_role_id' => 4
        ]);

        $this->get([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'view',
            1
        ]);

        $this->assertRedirect();
    }

    /**
     * Test add method
     *
     * @return void
     *
     * @throws
     */
    public function testReserve()
    {
        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $this->get([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'reserve',
            3
        ]);

        $this->assertResponseOk();

        $testData = [
            'user' => [
                'firstname' => 'Jacob',
                'lastname' => 'Tyler',
                'email' => 'j.a.g.tyler@me.com',
                'phone' => '07804 918252',
                'address_1' => '17 Appleton Mead',
                'address_2' => '',
                'city' => 'Biggleswade',
                'county' => 'Bedfordshire',
                'country' => 'United Kingdom',
                'postcode' => 'SG18 8HS'
            ],
            'attendee' => [
                'firstname' => 'Timmy',
                'lastname' => 'Tyler',
                'section_id' => '1'
            ],
            'logistics_item' => [
                0 => [
                    'logistic_id' => 1,
                    'param_id' => 2,
                ]
            ],
        ];

        $this->post([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'reserve',
            3
        ], $testData);

        $this->assertRedirect([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'view',
            2
        ]);

        $testData['attendee']['firstname'] = 'Joan';

        $this->post([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'reserve',
            3
        ], $testData);

        $this->assertRedirect([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'view',
            3
        ]);

        // Check Fills Up
        $testData['attendee']['firstname'] = 'Julie';

        $this->post([
            'prefix' => 'parent',
            'controller' => 'Reservations',
            'action' => 'reserve',
            3
        ], $testData);

        $this->assertNoRedirect();
        $this->assertFlashMessageAt(0, 'Spaces not available on Session.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testCancel()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
