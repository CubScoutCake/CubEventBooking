<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\LandingController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\LandingController Test Case
 */
class LandingControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */

    public $fixtures = [
        'app.settings',
        'app.districts',
        'app.scoutgroups',
        'app.roles',
        'app.users',
        'app.auth_roles',
        'app.password_states',
        'app.sections',
        'app.section_types',
        'app.setting_types',
        'app.notification_types',
        'app.notifications',
        'app.events', 'app.event_statuses',
        'app.event_types',
        'app.setting_types',
        'app.settings',
        'app.discounts',
        'app.applications', 'app.application_statuses',
        'app.invoices',
        'app.payments',
        'app.invoices_payments',
        'app.notes',
        'app.reservations',
        'app.attendees',
        'app.reservation_statuses',
    ];

    /**
     * Test userHome method
     *
     * @return void
     */
    public function testSuperUserHome()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/super_user');

        $this->assertResponseOk();
    }

    /**
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function testUserHomeUnauthenticatedFails()
    {
        // No session data set.
        $this->get('/super_user/landing/super-user-home');

        $this->assertRedirect();
    }

    /**
     * Test welcome method
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function testWelcome()
    {
        $this->get('/');

        $this->assertResponseOk();
    }
}
