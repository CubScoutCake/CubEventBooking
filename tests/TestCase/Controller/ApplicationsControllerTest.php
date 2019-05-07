<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ApplicationsController;
use App\Controller\Component\AvailabilityComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ApplicationsController Test Case
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @property \App\Controller\Component\AvailabilityComponent Availability
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
        'app.invoices',
        'app.invoice_items',
        'app.payments',
        'app.invoices_payments',
        'app.notes',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.logistics',
        'app.logistic_items',
        'app.email_sends',
        'app.tokens',
        'app.email_response_types',
        'app.email_responses',
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
     *
     * @throws
     */
    public function testSimpleBook()
    {
        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->get(['controller' => 'Applications', 'action' => 'simple_book', 2, '?' => ['section' => 6, 'non_section' => 1, 'leaders' => 1]]);
        $this->assertResponseOk();

        $this->get(['controller' => 'Applications', 'action' => 'simple_book', 2, '?' => ['section' => 7, 'non_section' => 1, 'leaders' => 1]]);
        $this->assertRedirect(['controller' => 'Events', 'action' => 'book', 2]);
        $this->assertFlashElement('Flash/error');
        $this->assertFlashMessage('The team size is limited, please select fewer attendees.');

        $this->post(
            ['controller' => 'Applications', 'action' => 'simple_book', 2, '?' => ['section' => 6, 'non_section' => 1, 'leaders' => 1]],
            [
                'team_leader' => 'Jacob Tyler',
                'attendees' => [
                    ['firstname' => 'Cub', 'lastname' => 'A', 'role_id' => 3, 'vegetarian' => false, ],
                    ['firstname' => 'Cub', 'lastname' => 'B', 'role_id' => 3, 'vegetarian' => false, ],
                    ['firstname' => 'Cub', 'lastname' => 'C', 'role_id' => 3, 'vegetarian' => false, ],
                    ['firstname' => 'Cub', 'lastname' => 'D', 'role_id' => 3, 'vegetarian' => false, ],
                    ['firstname' => 'Cub', 'lastname' => 'E', 'role_id' => 3, 'vegetarian' => false, ],
                    ['firstname' => 'Cub', 'lastname' => 'F', 'role_id' => 3, 'vegetarian' => false, ],
                    ['firstname' => 'Young Leader', 'lastname' => 'B', 'role_id' => 5, 'vegetarian' => false, ],
                    ['firstname' => 'Leader', 'lastname' => 'B', 'role_id' => 1, 'vegetarian' => true, ],
                ]
            ]
        );

        $this->assertFlashElement('Flash/success');
        $this->assertFlashMessage('Your Team has been registered.');
        $this->assertFlashMessage('Your Invoice has been created automatically.');
        $this->assertRedirect(['controller' => 'Applications', 'action' => 'view', 4]);

        $this->Applications = $this->getTableLocator()->get('Applications');

        $application = $this->Applications->get(4, ['contain' => [
            'Invoices.InvoiceItems.ItemTypes',
            'Attendees.Roles',
        ]]);

        /**
         * @var \App\Model\Entity\Invoice $invoice
         */
        $invoice = $application->invoice;

        $this->assertInstanceOf('App\Model\Entity\Invoice', $invoice);
        $this->assertEquals(1, $invoice->get('user_id'));
        $this->assertEquals(20, $invoice->get('balance'));
        $this->assertSame('INV #5', $invoice->get('display_code'));
        foreach ($invoice->invoice_items as $invoiceItem) {
            $this->assertTrue($invoiceItem->get('visible'));
            $this->assertEquals(20, $invoiceItem->get('value'));
            $this->assertSame('Team Booking Price', $invoiceItem->get('description'));
            $this->assertSame('Team Booking', $invoiceItem->item_type->item_type);
            $this->assertTrue($invoiceItem->item_type->team_price);
        }
    }

    /**
     * Test simpleBook method
     *
     * @return void
     *
     * @throws
     */
    public function testHoldBook()
    {
        $registry = new ComponentRegistry();
        $this->Availability = new AvailabilityComponent($registry);

        $numbers = $this->Availability->getEventApplicationNumbers(2);
        $expected = [
            'NumSection' => 5,
            'NumNonSection' => 4,
            'NumLeaders' => 1,
            'NumTeams' => 1,
        ];
        $this->assertEquals($expected, $numbers);

        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 1,
        ]);

        $this->Applications = $this->getTableLocator()->get('Applications');

        $this->post(['controller' => 'Applications', 'action' => 'hold_book', 2, '?' => ['section' => 7, 'non_section' => 1, 'leaders' => 1]]);
        $this->assertRedirect(['controller' => 'Events', 'action' => 'book', 2]);
        $this->assertFlashElement('Flash/error');
        $this->assertFlashMessageAt(0, 'The team size is limited, please select fewer attendees.');

        $this->post(['controller' => 'Applications', 'action' => 'hold_book', 2, '?' => ['section' => 6, 'non_section' => 4, 'leaders' => 3]]);
        $this->assertFlashElement('Flash/success');
        $this->assertFlashMessageAt(0, 'Your Booking Reservation has been made.');
        $this->assertFlashMessageAt(1, 'Your Invoice has been created automatically.');
        $this->assertRedirect(['controller' => 'Applications', 'action' => 'view', 4]);

        $application = $this->Applications->get(4, ['contain' => [
            'Invoices.InvoiceItems.ItemTypes',
            'Attendees.Roles',
        ]]);

        $this->assertEquals(['section' => '6', 'non_section' => '4', 'leaders' => '3', 'booking_type' => 'hold'], $application->hold_numbers);

        $numbers = $this->Availability->getEventApplicationNumbers(2);
        $expected = [
            'NumSection' => 11,
            'NumNonSection' => 8,
            'NumLeaders' => 4,
            'NumTeams' => 2,
            'BookingType' => 0,
            'Reserved' => true,
        ];
        $this->assertEquals($expected, $numbers);

        $numbers = $this->Availability->getApplicationNumbers(4);
        $expectedNumbers = [
            'NumSection' => '6',
            'NumNonSection' => '4',
            'NumLeaders' => '3',
            'NumTeams' => '1',
            'BookingType' => 'hold',
            'Reserved' => true,
        ];
        $this->assertEquals($expectedNumbers, $numbers);

        /**
         * @var \App\Model\Entity\Invoice $invoice
         */
        $invoice = $application->invoice;

        $this->assertInstanceOf('App\Model\Entity\Invoice', $invoice);
        $this->assertEquals(1, $invoice->get('user_id'));
        $this->assertEquals(20, $invoice->get('balance'));
        $this->assertSame('INV #5', $invoice->get('display_code'));
        foreach ($invoice->invoice_items as $invoiceItem) {
            $this->assertTrue($invoiceItem->get('visible'));
            $this->assertEquals(20, $invoiceItem->get('value'));
            $this->assertSame('Team Booking Price', $invoiceItem->get('description'));
            $this->assertSame('Team Booking', $invoiceItem->item_type->item_type);
            $this->assertTrue($invoiceItem->item_type->team_price);
        }
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
