<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\SuperUser;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\PaymentsController Test Case
 */
class PaymentsControllerTest extends IntegrationTestCase
{
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
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthenticatedFails()
    {
        $this->markTestIncomplete('SuperUser');

        // No session data set.
        $this->get('/Payments');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*$this->session(['Auth.User.id' => 1]);

        $this->get('/payments');

        $this->assertResponseOk();*/
    }
}
