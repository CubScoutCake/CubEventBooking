<?php
namespace App\Test\TestCase\Controller\Parent;

use App\Controller\Parent\ReservationsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Parent\ReservationsController Test Case
 *
 * @property \App\Model\Table\ReservationStatusesTable $ReservationStatuses
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
        'app.sessions',
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
        $this->ReservationStatuses = $this->getTableLocator()->get('ReservationStatuses');
        $this->ReservationStatuses->installBaseStatuses();

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
