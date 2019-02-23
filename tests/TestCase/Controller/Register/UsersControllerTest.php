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
        'app.allergies',
        'app.application_statuses',
        'app.applications',
        'app.applications_attendees',
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
     * @throws \PHPUnit\Exception
     */
    public function testRegisterSectionRedirect()
    {
        $this->get(['prefix' => 'register', 'controller' => 'Users', 'action' => 'register']);

        $this->assertRedirect(['prefix' => 'register', 'controller' => 'Sections', 'action' => 'select']);
    }

    /**
     * Register
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function testRegisterGet()
    {
        $this->get('/register/users/register/1');

        $this->assertResponseOk();
    }

    /**
     * Test Register Post
     *
     * @return void
     *
     * @throws
     */
    public function testRegisterPost()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $data = [
            'role_id' => 2,
            'firstname' => 'Wendy',
            'lastname' => 'Bloggs',
            'email' => 'joe.bloggs@wendy.cool',
            'membership_number' => random_int(111111, 999999),
            'username' => 'WendyThisUser',
            'password' => 'SuperSecure',
            'phone' => '01462 628819',
            'address_1' => 'Here is',
            'address_2' => 'The Way',
            'city' => 'to',
            'county' => 'Ammarillo',
            'postcode' => 'GO8 0FK',
        ];
        $this->post('/register/users/register/1', $data);

        $this->assertRedirect([
            'controller' => 'Landing',
            'action' => 'user_home',
            'prefix' => false,
        ]);

        $this->assertFlashMessageAt(1, 'You have successfully registered!');
        $this->assertFlashMessageAt(0, 'An Attendee for your user has been created.');
    }
}
