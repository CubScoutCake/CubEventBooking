<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\SuperUser;

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
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'controller' => 'ApplicationStatuses',
            'action' => 'view',
            'prefix' => 'super_user',
            1,
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
            'Auth.User.auth_role_id' => 2,
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
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'controller' => 'ApplicationStatuses',
            'action' => 'edit',
            'prefix' => 'super_user',
            1,
        ]);

        $this->assertResponseOk();

        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'ApplicationStatuses',
            'action' => 'edit',
            'prefix' => 'super_user',
            1,
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
            'Auth.User.auth_role_id' => 2,
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
            2,
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The application status has been deleted.');
    }
}
