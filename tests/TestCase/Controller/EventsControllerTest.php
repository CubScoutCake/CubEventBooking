<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EventsController Test Case
 */
class EventsControllerTest extends IntegrationTestCase
{

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
        'app.champions',
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
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/events');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     *
     * @throws
     */
    public function testBookGet()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get('/events/book/2');

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     *
     * @throws
     */
    public function testBookPost()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/events/book/2', ['section' => 1, 'non_section' => 2, 'leaders' => 3, 'booking_type' => 'list']);
        $this->assertRedirect(['controller' => 'Applications', 'action' => 'simple_book', 2, '?' => ['section' => 1, 'non_section' => 2, 'leaders' => 3]]);

        $this->post('/events/book/2', ['section' => 1, 'non_section' => 2, 'leaders' => 3, 'booking_type' => 'hold']);
        $this->assertRedirect(['controller' => 'Applications', 'action' => 'hold_book', 2, '?' => ['section' => 1, 'non_section' => 2, 'leaders' => 3]]);
    }

    /**
     * Test edit method
     *
     * @return void
     *
     * @throws
     */
    public function testBookPostLimits()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        /** @var \App\Model\Table\EventsTable $events */
        $events = $this->getTableLocator()->get('Events');
        $events->EventStatuses->installBaseStatuses();

        /** @var \App\Model\Entity\Event $limitedEvent */

        $limitedEvent = $events->get(2, ['contain' => 'Prices']);

        $this->assertTrue($limitedEvent->max);
        $this->assertEquals(2, $limitedEvent->max_apps);
        foreach ($limitedEvent->prices as $price) {
            if ($price->item_type_id == 1) {
                $this->assertEquals(6, $price->max_number);
            }
        }

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();

        $this->post('/events/book/2', ['section' => 7, 'non_section' => 2, 'leaders' => 3]);

        $this->assertNoRedirect();
        $this->assertFlashElement('Flash/error');
        $this->assertFlashMessage('The team size is limited, please select fewer attendees.');

        $this->post('/events/book/2', ['section' => 5, 'non_section' => 2, 'leaders' => 3, 'booking_type' => 'list']);
        $this->assertRedirect(['controller' => 'Applications', 'action' => 'simple_book', 2, '?' => ['section' => 5, 'non_section' => 2, 'leaders' => 3]]);

        $this->post('/events/book/2', ['section' => 5, 'non_section' => 2, 'leaders' => 3, 'booking_type' => 'hold']);
        $this->assertRedirect(['controller' => 'Applications', 'action' => 'hold_book', 2, '?' => ['section' => 5, 'non_section' => 2, 'leaders' => 3]]);

        $limitedEvent->set('max_apps', 1);
        $limitedEvent = $events->save($limitedEvent);

        $this->assertEquals(1, $limitedEvent->max_apps);

        $this->post('/events/book/2', ['section' => 5, 'non_section' => 2, 'leaders' => 3, 'booking_type' => 'list']);
        $this->assertNoRedirect();
        $this->assertFlashElement('Flash/error');
        $this->assertFlashMessage('Apologies this Event is Not Currently Accepting Applications.');
    }
}
