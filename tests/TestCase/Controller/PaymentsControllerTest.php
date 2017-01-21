<?php
namespace App\Test\TestCase\Controller;

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
        'app.invoices_payments',
        'app.invoices',
        'app.applications',
        'app.events',
        'app.setting_types',
        'app.settings',
        'app.discounts',
        'app.districts',
        'app.auth_roles',
        'app.scoutgroups',
        'app.sections',
        'app.section_types',
        'app.roles',
        'app.users',
        'app.event_types',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/Payments');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function testIndex()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/payments');

        $this->assertResponseOk();
    }
}
