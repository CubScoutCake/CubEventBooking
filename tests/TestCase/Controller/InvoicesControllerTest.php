<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InvoicesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\InvoicesController Test Case
 */
class InvoicesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoices',
        'app.users',
        'app.roles',
        'app.applications',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.events',
        'app.attendees',
        'app.scoutgroups',
        'app.districts',
        'app.section_types',
        'app.sections',
        'app.notes',
        'app.invoice_items',
        'app.item_types',
        'app.payments',
        'app.prices',
        'app.invoices_payments',
        'app.discounts',
        'app.notifications',
        'app.notification_types',
        'app.password_states',
        'app.allergies',
        'app.applications_attendees',
        'app.attendees_allergies',
        'app.auth_roles',
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

    public function testIndexUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/invoices');

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login', 'redirect' => '/invoices']);
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

        $this->assertResponseOk();
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
        $this->assertResponseOk();
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
