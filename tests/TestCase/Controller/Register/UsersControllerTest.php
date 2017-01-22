<?php
namespace App\Test\TestCase\Controller\Register;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\UsersController Test Case
 */
class UsersControllerTest extends IntegrationTestCase
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
    public function testRegisterSectionRedirect()
    {
        $this->get(['prefix' => 'register', 'controller' => 'Users', 'action' => 'register']);

        $this->assertRedirect(['prefix' => 'register', 'controller' => 'Sections', 'action' => 'select']);
    }

    public function testRegisterGet()
    {
        $this->get('/register/users/register/1');

        $this->assertResponseOk();
    }

    public function testRegisterPost()
    {
        $this->markTestSkipped('Needs to be fixed.');

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'role_id' => 1,
            'firstname' => 'Joe',
            'lastname' => 'Bloggs',
            'email' => 'joe.bloggs@somewhere.cool',
            'username' => 'ThisUser',
            'password' => 'SuperSecure',
            'phone' => '0892 912912',
            'address_1' => 'Here is',
            'address_2' => 'The Way',
            'city' => 'to',
            'membership_number' => 82925,
            'county' => 'Ammarillo',
            'postcode' => 'GO8 0FK',
            'section_id' => 1,
        ];
        $this->post('/register/users/register/1', $data);

        $this->assertRedirect();
    }

    public function testRegisterPostBadCsrf()
    {
        $this->markTestIncomplete();
    }

    public function testRegisterPostBadSecurity()
    {
        $this->markTestIncomplete();
    }

    public function testRegisterPostBadData()
    {
        $this->markTestIncomplete();
    }
}
