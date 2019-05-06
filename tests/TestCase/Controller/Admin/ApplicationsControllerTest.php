<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\ApplicationsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\ApplicationsController Test Case
 */
class ApplicationsControllerTest extends IntegrationTestCase
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

    public $Applications;

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/applications');

        $this->assertResponseOk();
    }

    /**
     * Test bookings method
     *
     * @return void
     *
     * @throws
     */
    public function testBookings()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/applications/index/2');

        $this->assertResponseOk();

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/applications/index');

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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/applications/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test pdfView method
     *
     * @return void
     */
    public function testPdfView()
    {
        $this->markTestSkipped('Prices implementation required.');

        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        //$this->get('/admin/applications/view/1.pdf');

        $this->assertResponseOk();

        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        //$this->get('/admin/applications/pdf-view/1');

        $this->assertRedirect();
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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'action' => 'add',
            'controller' => 'Applications',
            'prefix' => 'admin'
        ]);

        $this->assertResponseOk();

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'action' => 'add',
            'controller' => 'Applications',
            'prefix' => 'admin'
        ], [
            'user_id' => 1,
            'event_id' => 2,
            'section_id' => 1,
            'permit_holder' => 'Jacob Tyler',
            'team_leader' => 'Jacob Tyler',
        ]);

        $this->assertRedirect();

        $this->assertFlashMessageAt(0, 'Application has been registered.');
        $this->assertFlashMessageAt(1, 'Invoice created.');
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

        $this->get('/admin/applications/edit/1');

        $this->assertResponseOk();

        /** @var \App\Model\Table\ApplicationsTable $applications */
        $applications = TableRegistry::getTableLocator()->get('Applications');

        $before = $applications->get(1);

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'action' => 'edit',
            'controller' => 'Applications',
            'prefix' => 'admin',
            1
        ], [
            'user_id' => 1,
            'event_id' => 2,
            'section_id' => 1,
            'permit_holder' => 'Jacob Tyler',
            'team_leader' => 'Jacob Tyler',
        ]);

        $this->assertRedirect();

        $this->assertFlashMessageAt(0, 'The application has been saved.');

        $after = $applications->get(1);
        $this->assertNotSame($before, $after);
    }

    /**
     * Test link method
     *
     * @return void
     */
    public function testLink()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/applications/link/1');

        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/admin/applications/delete/1');

        $this->assertRedirect();
    }
}
