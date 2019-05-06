<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\InvoicesController;
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
        'app.Allergies',
        'app.ApplicationStatuses',
        'app.Applications',
        'app.ApplicationsAttendees',
        'app.Attendees',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Champions',
        'app.Discounts',
        'app.Districts',
        'app.EmailResponseTypes',
        'app.EmailResponses',
        'app.EmailSends',
        'app.EventStatuses',
        'app.EventTypes',
        'app.Events',
        'app.InvoiceItems',
        'app.Invoices',
        'app.InvoicesPayments',
        'app.ItemTypes',
        'app.LogisticItems',
        'app.Logistics',
        'app.Notes',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.PasswordStates',
        'app.Payments',
        'app.Prices',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Roles',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.SettingTypes',
        'app.Settings',
        'app.Users',
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
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'index'
        ]);

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
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'view',
            1
        ]);

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
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'edit',
            1
        ]);

        $this->assertResponseOk();

        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();

        $this->post([
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'edit',
            1
        ], [
            'user_id' => 3,
            'application_id' => 1,
        ]);

        $this->assertFlashMessageAt(0, 'The invoice has been saved.');

        $this->assertRedirect();

        $this->post([
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'edit',
            1
        ], [
            'user_id' => 100,
            'application_id' => 100,
        ]);

        $this->assertFlashMessageAt(0, 'The invoice could not be saved. Please, try again.');

        $this->assertResponseOk();
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
     * Test regenerate method
     *
     * @return void
     *
     * @throws
     */
    public function testRegenerate()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableRetainFlashMessages();

        $this->get([
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'regenerate',
            1
        ]);

        $this->assertFlashMessageAt(0, 'Invoice Regenerated from Application.');

        $this->assertRedirect();

        $this->get([
            'controller' => 'Invoices',
            'prefix' => 'admin',
            'action' => 'regenerate',
            1,
            '?' => [
                'force' => true,
            ]
        ]);

        $this->assertFlashMessageAt(0, 'Invoice Regenerated from Application (bypassing limits).');

        $this->assertRedirect();
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
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorizedFails()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
