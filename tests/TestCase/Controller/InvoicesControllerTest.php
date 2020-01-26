<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

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
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

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
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

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
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get([
            'action' => 'regenerate',
            'controller' => 'Invoices',
            'prefix' => false,
            1,
        ]);

        $this->assertRedirect();

        $this->assertFlashMessage('This event has been LOCKED to prevent updates to invoices. Please contact Admin Joe.');

        /** @var \App\Model\Table\EventsTable $events */
        $events = TableRegistry::getTableLocator()->get('Events');
        $events->EventStatuses->installBaseStatuses();
        $event = $events->get(2);
        $event->set('invoices_locked', false);
        $events->save($event);

        $this->get([
            'action' => 'regenerate',
            'controller' => 'Invoices',
            'prefix' => false,
            1,
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
