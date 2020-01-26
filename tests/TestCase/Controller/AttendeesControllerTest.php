<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Admin\AttendeesController Test Case
 */
class AttendeesControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sessions',
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
           'Auth.User.auth_role_id' => 1,
        ]);

        $this->get('/attendees');

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
           'Auth.User.auth_role_id' => 2,
        ]);

        $this->get('/attendees/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test adult method
     *
     * @return void
     *
     * @throws
     */
    public function testAdult()
    {
        $this->markTestIncomplete();
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'controller' => 'Attendees',
            'action' => 'add',
            '?' => [
                'section' => true,
            ],
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test cub method
     *
     * @return void
     *
     * @throws
     */
    public function testSection()
    {
        $this->markTestIncomplete();
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'controller' => 'Attendees',
            'action' => 'add',
            '?' => [
                'section' => true,
            ],
        ]);

        $this->assertResponseOk();
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
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'controller' => 'Attendees',
            'action' => 'edit',
            1,
        ]);

        $this->assertResponseOk();

        $attendees = TableRegistry::getTableLocator()->get('Attendees');
        $before = $attendees->get(1);

        $this->enableSecurityToken();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();

        $postData = [
            'section_id' => 1,
            'role_id' => 1,
            'firstname' => 'Goat',
            'lastname' => 'Face',
            'dateofbirth' => [
                'year' => 2016,
                'month' => 12,
                'day' => 29,
            ],
            'phone' => '01440 319883',
            'phone2' => '07849 291821',
            'address_1' => 'Happy Land',
            'address_2' => 'Llama Place',
            'city' => 'Vision City',
            'county' => 'Hertfordshire',
            'postcode' => 'SG5 9SQ',
            'nightsawaypermit' => true,
            'applications' => [
                '_ids' => [
                    1, 2,
                ],
            ],
            'allergies' => [
                '_ids' => [
                    1, 2,
                ],
            ],
        ];

        $this->post([
            'controller' => 'Attendees',
            'action' => 'edit',
            1,
        ], $postData);

        $this->assertRedirect([
            'controller' => 'Attendees',
            'action' => 'view',
            1,
        ]);
        $this->assertFlashMessageAt(0, 'The attendee has been saved.');

        $after = $attendees->get(1);

        $this->assertNotSame($before, $after);

        foreach ($postData as $key => $field) {
            if (!in_array($key, ['dateofbirth', 'applications', 'allergies'])) {
                $this->assertSame($after->get($key), $field);
            }
        }
    }

    /**
     * Test delete method
     *
     * @return void
     *
     * @throws
     */
    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $this->session([
            'Auth.User.id' => 2,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->post([
            'controller' => 'Attendees',
            'action' => 'delete',
            'prefix' => false,
            1,
        ]);
        $this->assertRedirect();
//        $this->assertFlashMessageAt(0, 'You are not authorised to perform this action.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'controller' => 'Attendees',
            'action' => 'view',
            'prefix' => false,
            1,
        ]);
        $this->assertResponseOk();

        $this->post([
            'controller' => 'Attendees',
            'action' => 'delete',
            'prefix' => false,
            1,
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The attendee has been deleted.');
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
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2,
        ]);

        $this->get('/attendees/edit/1');

        $this->assertResponseOk();

        $this->session([
            'Auth.User.id' => 2,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get('/attendees/edit/1');

        $this->assertRedirect();
    }
}
