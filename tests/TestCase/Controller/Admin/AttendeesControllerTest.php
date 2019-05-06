<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\AttendeesController;
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

        $this->get('/admin/attendees');

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

        $this->get('/admin/attendees/view/1');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get([
            'prefix' => 'admin',
            'controller' => 'Attendees',
            'action' => 'edit',
            1
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
                ]
            ],
            'allergies' => [
                '_ids' => [
                    1, 2,
                ]
            ],
        ];

        $this->post([
            'controller' => 'Attendees',
            'action' => 'edit',
            1
        ], $postData);

        $this->assertRedirect([
            'prefix' => 'admin',
            'controller' => 'Attendees',
            'action' => 'view',
            1
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
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $this->post([
            'controller' => 'Attendees',
            'action' => 'delete',
            'prefix' => 'admin',
            1
        ]);

        $this->assertRedirect();
        $this->assertFlashMessageAt(0, 'The attendee has been deleted.');
    }
}
