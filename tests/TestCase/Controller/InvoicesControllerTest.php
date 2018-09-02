<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InvoicesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\InvoicesController Test Case
 */
class InvoicesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
        'app.invoices',
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
        'app.discounts',
        'app.auth_roles',
        'app.password_states',
        'app.notes',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments',
        'app.tokens',
        'app.email_sends',
        'app.email_responses',
        'app.email_response_types',
        'app.event_types',
        'app.setting_types',
        'app.settings',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies'
    ];

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/invoices');

        $this->assertResponseOk();
    }

    public function testViewUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/invoices/view/1');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/invoices/view/1']);
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/invoices/view/1');

        $this->assertRedirect();
    }

    /**
     * Test pdfView method
     *
     * @return void
     */
    public function testPdfView()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test generate method
     *
     * @return void
     */
    public function testGenerate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test regenerate method
     *
     * @return void
     */
    public function testRegenerate()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test discount method
     *
     * @return void
     */
    public function testDiscount()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test sendFile method
     *
     * @return void
     */
    public function testSendFile()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorized()
    {
        $this->session(['Auth.User.id' => 1]);
        $this->get('/invoices/view/1');
        $this->assertRedirect();
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorizedFails()
    {
        $this->session(['Auth.User.id' => 2]);
        $this->get('/invoices/view/2');
        $this->assertRedirect();
    }
}
