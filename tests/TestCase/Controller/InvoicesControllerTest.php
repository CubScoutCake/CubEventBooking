<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InvoicesController;
use Cake\ORM\TableRegistry;
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
     */
    public $fixtures = [
        'app.allergies',
        'app.application_statuses',
        'app.applications_attendees',
        'app.applications',
        'app.attendees',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.champions',
        'app.discounts',
        'app.districts',
        'app.email_response_types',
        'app.email_responses',
        'app.email_sends',
        'app.event_statuses',
        'app.event_types',
        'app.events',
        'app.invoice_items',
        'app.invoices',
        'app.invoices_payments',
        'app.item_types',
        'app.logistic_items',
        'app.logistics',
        'app.notes',
        'app.notification_types',
        'app.notifications',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.password_states',
        'app.payments',
        'app.prices',
        'app.reservation_statuses',
        'app.reservations',
        'app.roles',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.setting_types',
        'app.settings',
        'app.users',
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
     *
     * @throws
     */
    public function testIndex()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/invoices');

        $this->assertResponseOk();
    }

    /**
     * Test Authentication Method
     *
     * @return void
     *
     * @throws
     */
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
     *
     * @throws
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
     *
     * @throws
     */
    public function testRegenerate()
    {
        $this->enableRetainFlashMessages();

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get([
            'action' => 'regenerate',
            'controller' => 'Invoices',
            'prefix' => false,
            1
        ]);

        $this->assertRedirect();

        $this->assertFlashMessage('This event has been LOCKED to prevent updates to invoices. Please contact Jacob Tyler.');

        $events = TableRegistry::getTableLocator()->get('Events');
        $event = $events->get(2);
        $event->set('invoices_locked', false);
        $events->save($event);

        $this->get([
            'action' => 'regenerate',
            'controller' => 'Invoices',
            'prefix' => false,
            1
        ]);

        $this->assertRedirect();

        $this->assertFlashMessage('Your Invoice has been updated from your Application.');
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
     *
     * @throws
     */
    public function testIsAuthorized()
    {
        $this->session(['Auth.User.id' => 2]);
        $this->get('/invoices/view/1');
        $this->assertRedirect();
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     *
     * @throws
     */
    public function testIsAuthorizedFails()
    {
        $this->session(['Auth.User.id' => 2]);
        $this->get('/invoices/view/2');
        $this->assertRedirect();
    }
}
