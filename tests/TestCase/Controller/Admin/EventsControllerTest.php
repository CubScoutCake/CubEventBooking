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

        $this->get(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'index']);

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

        $this->get(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'view', 1]);

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

        /*$this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'add'],[
            'name' => 'Cyclocross',
            'full_name' => 'County Cub Cyclocross',
            'event_type_id' => 1,
            'section_type_id' => 1,
            'start_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'deposit_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'end_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'closing_date' => [
                'year' => 2018,
                'month' => 02,
                'day' => 05,
                'hour' => 00,
                'minute' => 15,
            ],
            'live' => 1,
            'new_apps' => 1,
            'team_price' => 0,
            'allow_reductions' => 0,
            'invoices_locked' => 0,
            'location' => 'Well End',
            'intro_text' => 'Jacob',
            'tagline_text' => 'This',
            'logo' => '/Monkey.png',
            'admin_firstname' => 'Joe',
            'admin_lastname' => 'Bloggs',
            'admin_email' => 'fish@sig.com',
            'admin_user_id' => 1,
            'address' => '17 Appleton Mead',
            'city' => 'Biggleswade',
            'county' => 'Hertfordshire',
            'postcode' => 'SG18 8HS',
            'max' => 1,
            'max_apps' => '36',
            'max_section' => null,
            'discount_id' => null,
        ]);

        $this->assertResponseOk();
        $this->assertRedirect();*/
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

        $this->get(['controller' => 'Events', 'prefix' => 'admin', 'action' => 'prices', 1]);

        $this->assertResponseOk();
    }
}
