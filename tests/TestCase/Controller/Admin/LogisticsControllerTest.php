<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\LogisticsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Admin\LogisticsController Test Case
 */
class LogisticsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
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
            'controller' => 'Logistics',
            'action' => 'index',
            'prefix' => 'admin',
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
            'controller' => 'Logistics',
            'action' => 'view',
            'prefix' => 'admin',
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
            'controller' => 'Logistics',
            'action' => 'add',
            'prefix' => 'admin',
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'Logistics',
            'action' => 'add',
            'prefix' => 'admin',
        ], [
            'event_id' => 2,
            'header' => 'LLama',
            'text' => 'Choose session (09:30 - 12:00 or 13:00 - 17:00)',
            'parameter_id' => 1,
            'max_value' => 5,
            'variable_max_values' => [
                'params' => [
                    1 => 5,
                    2 => 6,
                ],
                'option_count' => 2,
            ]
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The logistic has been saved.');
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
            'controller' => 'Logistics',
            'action' => 'edit',
            'prefix' => 'admin',
            1
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'Logistics',
            'action' => 'edit',
            'prefix' => 'admin',
            1
        ], [
            'event_id' => 2,
            'header' => 'Session',
            'text' => 'Choose session (08:30 - 12:00 or 12:30 - 17:00)',
            'parameter_id' => 1,
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The logistic has been saved.');
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

        $this->post([
            'controller' => 'Logistics',
            'action' => 'delete',
            'prefix' => 'admin',
            1
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The logistic has been deleted.');
    }
}
