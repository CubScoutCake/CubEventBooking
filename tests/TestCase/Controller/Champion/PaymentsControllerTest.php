<?php
namespace App\Test\TestCase\Controller\Champion;

use App\Controller\PaymentsController;
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
        'app.payments',
        'app.users',
        'app.auth_roles',
        'app.section_types',
        'app.sections',
        'app.event_types',
        'app.roles',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.events',
        'app.settings',
        'app.settingtypes',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.invoices',
        'app.invoice_items',
        'app.itemtypes',
        'app.notes',
        'app.invoices_payments',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.notifications',
        'app.notificationtypes'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/champion/payments');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'prefix' => false, 'redirect' => '/champion/payments']);
    }

    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*$this->session(['Auth.User.id' => 1]);

        $this->get('/payments');

        $this->assertResponseOk();*/
    }
}
