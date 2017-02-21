<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\EventsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\EventsController Test Case
 */
class EventsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.event_types',
        'app.events',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.users',
        'app.password_states',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications',
        'app.invoices',
        'app.invoice_items',
        'app.item_types',
        'app.prices',
        'app.notes',
        'app.prices',
        'app.payments',
        'app.invoices_payments',
        'app.logistic_items',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types'
    ];

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

        $this->get('/admin/events');

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/events/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test fullView method
     *
     * @return void
     */
    public function testFullView()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/events/full-view/1');

        $this->assertResponseOk();
    }

    /**
     * Test fullView method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
            'Auth.User.section_id' => 1,
        ]);

        $this->get('/admin/events/add');

        $this->assertResponseOk();
    }

    /**
     * Test fullView method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/events/edit/1');

        $this->assertResponseOk();
    }

    /**
     * Test fullView method
     *
     * @return void
     */
    public function testPrices()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/admin/events/prices/1');

        $this->assertResponseOk();
    }
}
