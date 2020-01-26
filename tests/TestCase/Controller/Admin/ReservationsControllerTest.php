<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Admin;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Admin\ReservationsController Test Case
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
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
    public function testIndex()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get(['controller' => 'Reservations', 'prefix' => 'admin', 'action' => 'index']);

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
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get(['controller' => 'Reservations', 'prefix' => 'admin', 'action' => 'view', 1]);

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
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->Reservations = TableRegistry::getTableLocator()->get('Reservations');
        $this->Reservations->ReservationStatuses->installBaseStatuses();

        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $this->get([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'add',
            3,
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
                'postcode' => 'SG18 8HS',
            ],
            'attendee' => [
                'firstname' => 'Timmy',
                'lastname' => 'Tyler',
                'section_id' => '1',
            ],
            'logistics_item' => [
                0 => [
                    'logistic_id' => 1,
                    'param_id' => 2,
                ],
            ],
        ];

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->post([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'add',
            3,
        ], $testData);

        $this->assertRedirect([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'view',
            2,
        ]);

        $testData['attendee']['firstname'] = 'Joan';

        $this->post([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'add',
            3,
        ], $testData);

        $this->assertRedirect([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'view',
            3,
        ]);

        // Check Bypasses Fill
        $testData['attendee']['firstname'] = 'Julie';

        $this->post([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'add',
            3,
        ], $testData);

        $this->assertRedirect([
            'prefix' => 'admin',
            'controller' => 'Reservations',
            'action' => 'view',
            4,
        ]);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testExtend()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
