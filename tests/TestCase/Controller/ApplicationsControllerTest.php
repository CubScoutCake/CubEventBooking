<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ApplicationsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ApplicationsController Test Case
 */
class ApplicationsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
           'Auth.User.auth_role_id' => 1
        ]);

        $this->get('/applications');

        $this->assertResponseOk();
    }

    /**
     * Test bookings method
     *
     * @return void
     */
    public function testBookings()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test invoice method
     *
     * @return void
     */
    public function testInvoice()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
            'Auth.User.auth_role_id' => 1
        ]);

        $this->get(['controller' => 'Applications', 'action' => 'view', 1]);

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
     * Test book method
     *
     * @return void
     */
    public function testBook()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test simpleBook method
     *
     * @return void
     */
    public function testSimpleBook()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test syncBook method
     *
     * @return void
     */
    public function testSyncBook()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test chooseOsmEvent method
     *
     * @return void
     */
    public function testChooseOsmEvent()
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
     * Test link method
     *
     * @return void
     */
    public function testLink()
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
     * Test isAuthorized method
     *
     * @return void
     */
    public function testIsAuthorized()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
