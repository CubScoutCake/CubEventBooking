<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\SuperUser;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SuperUser\TaskTypesController Test Case
 */
class TaskTypesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.champions',
        'app.sessions',
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
            'controller' => 'TaskTypes',
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
            'controller' => 'TaskTypes',
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
            'controller' => 'TaskTypes',
            'action' => 'add',
            'prefix' => 'super_user',
        ]);

        $this->assertResponseOk();

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'TaskTypes',
            'action' => 'add',
            'prefix' => 'super_user',
        ], [
            'task_type' => 'Attendee Clean',
            'shared_type' => '0',
            'type_icon' => 'users',
            'type_code' => 'ATC',
            'task_requirement' => 'Please review the attendees you have in the system and remove their details if they are no longer in your section.',
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The task type has been saved.');
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
            'controller' => 'TaskTypes',
            'action' => 'edit',
            'prefix' => 'super_user',
            1,
        ]);

        $this->assertResponseOk();

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'TaskTypes',
            'action' => 'edit',
            'prefix' => 'super_user',
            1,
        ], [
            'task_type' => 'Attendee Clean',
            'shared_type' => '0',
            'type_icon' => 'users',
            'type_code' => 'ATC',
            'task_requirement' => 'Please review the attendees you have in the system and remove their details if they are no longer in your section.',
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The task type has been saved.');
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

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'TaskTypes',
            'action' => 'delete',
            'prefix' => 'super_user',
            2,
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The task type has been deleted.');
    }
}
