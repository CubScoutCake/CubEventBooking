<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailSendsTable;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailSendsTable Test Case
 */
class EmailSendsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailSendsTable
     */
    public $EmailSends;

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
        'app.attendees_allergies',
        'app.attendees',
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
        'app.invoices_payments',
        'app.invoices',
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
        'app.task_types',
        'app.tasks',
        'app.tokens',
        'app.users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EmailSends') ? [] : ['className' => EmailSendsTable::class];
        $this->EmailSends = TableRegistry::getTableLocator()->get('EmailSends', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailSends);

        parent::tearDown();
    }

    /**
     * Get Good Set Function
     *
     * @return array
     *
     * @throws
     */
    private function getGood()
    {
        $now = FrozenTime::getTestNow();
        $good = [
            'sent' => $now,
            'message_send_code' => 'PSJs' . random_int(111, 999) . 'sxa928as' . random_int(111, 999) . 'SMZX9',
            'user_id' => 1,
            'subject' => 'Lorem ipsum dolor sit amet',
            'routing_domain' => 'Lorem ipsum dolor sit amet',
            'from_address' => 'Lorem ipsum dolor sit amet',
            'friendly_from' => 'Lorem ipsum dolor sit amet',
            'notification_type_id' => 1,
            'notification_id' => 1,
            'deleted' => null,
            'email_generation_code' => 'RSV-' . random_int(111, 999) . '-' . random_int(1, 9) . 'DR',
            'email_template' => 'reservation',
            'include_token' => true,
        ];

        return $good;
    }

    /**
     * Get Expected Function
     *
     * @return array
     *
     * @throws
     */
    private function getExpected()
    {
        return [
            'id' => 2,
            'message_send_code' => null,
            'user_id' => 1,
            'subject' => 'Reservation Confirmation 1-1-PLX',
            'routing_domain' => null,
            'from_address' => null,
            'friendly_from' => null,
            'notification_type_id' => 8,
            'notification_id' => 2,
            'email_generation_code' => 'RSV-1-NEW',
            'email_template' => 'reservation',
            'include_token' => true,
            'tokens' => [
                [
                    'id' => 2,
                    'email_send_id' => 2,
                    'utilised' => null,
                    'active' => true,
                    'token_header' => [
                        'redirect' => [
                            0 => 1,
                            'action' => 'view',
                            'prefix' => 'parent',
                            'controller' => 'Reservations',
                        ],
                        'authenticate' => true,
                    ],
                ],
            ],
            'notification' => [
                'notification_header' => 'Reservation Confirmation 1-1-PLX',
                'id' => 2,
                'user_id' => 1,
                'notification_type_id' => 8,
                'new' => true,
                'text' => null,
                'read_date' => null,
                'notification_source' => 'User',
                'link_id' => null,
                'link_controller' => null,
                'link_prefix' => false,
                'link_action' => null,
            ],
            'notification_type' => [
                'id' => 8,
                'notification_type' => 'Reservation Confirmation',
                'notification_description' => 'Reservation received, awaiting payment.',
                'icon' => 'fa-ticket-alt',
                'type_code' => 'RSV-NEW',
            ],
        ];
    }

    /**
     * Test initialize method
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testInitialize()
    {
        $actual = $this->EmailSends->get(1)->toArray();

        $dates = [
            'sent',
            'created',
            'modified',
            'deleted',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\FrozenTime', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'message_send_code' => 'PSJs821sxa928as219SMZX9',
            'user_id' => 1,
            'subject' => 'Lorem ipsum dolor sit amet',
            'routing_domain' => 'Lorem ipsum dolor sit amet',
            'from_address' => 'Lorem ipsum dolor sit amet',
            'friendly_from' => 'Lorem ipsum dolor sit amet',
            'notification_type_id' => 1,
            'notification_id' => 1,
            'email_generation_code' => 'RSV-2-5DR',
            'email_template' => 'reservation',
            'include_token' => true,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->EmailSends->find('all')->count();
        $this->assertEquals(1, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     *
     * @throws
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->EmailSends->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));

        $empties = [
            'sent',
            'message_send_code',
            'user_id',
            'subject',
            'routing_domain',
            'from_address',
            'friendly_from',
            'notification_type_id',
            'notification_id',
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->EmailSends->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Notification Exists
        $values = $this->getGood();

        $notifications = $this->EmailSends->Notifications->find('list')->toArray();

        $notification = max(array_keys($notifications));

        $values['notification_id'] = $notification;
        $new = $this->EmailSends->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));

        $values['notification_id'] = $notification + 1;
        $new = $this->EmailSends->newEntity($values);
        $this->assertFalse($this->EmailSends->save($new));

        // Notification Type Exists
        $values = $this->getGood();

        $types = $this->EmailSends->NotificationTypes->find('list')->toArray();

        $type = max(array_keys($types));

        $values['notification_type_id'] = $type;
        $new = $this->EmailSends->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));

        $values['notification_type_id'] = $type + 1;
        $new = $this->EmailSends->newEntity($values);
        $this->assertFalse($this->EmailSends->save($new));

        // Users Exist
        $values = $this->getGood();

        $users = $this->EmailSends->Users->find('list')->toArray();

        $user = max(array_keys($users));

        $values['user_id'] = $user;
        $new = $this->EmailSends->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));

        $values['user_id'] = $user + 1;
        $new = $this->EmailSends->newEntity($values);
        $this->assertFalse($this->EmailSends->save($new));
    }

    /**
     * Test Make method
     *
     * @return void
     *
     * @throws
     */
    public function testMake()
    {
        $makeArray = [
            'RSV-1-NEW' => 2,
            'RSV-1-CNF' => 3,
        ];

        foreach ($makeArray as $genCode => $expId) {
            $result = $this->EmailSends->make($genCode);
            $this->assertEquals($expId, $result);

            // Check second is blocked.
            $this->assertFalse($this->EmailSends->make($genCode));
        }

        $expected = $this->getExpected();

        $actual = $this->EmailSends->get(2, [
            'contain' => [
                'NotificationTypes',
                'Notifications',
                'Tokens',
            ]])->toArray();

        $dates = [
            'sent',
            'created',
            'modified',
            'deleted',
            'expires',
        ];

        foreach ($dates as $date) {
            unset($actual[$date]);
            unset($actual['tokens'][0][$date]);
            unset($actual['notification'][$date]);
        }
        unset($actual['tokens'][0]['random_number']);

        $this->assertEquals($expected, $actual);

        $exemptMakeArray = [
            'RSV-1-VIE' => 4,
            'USR-1-PWD' => 7,
        ];

        foreach ($exemptMakeArray as $genCode => $expId) {
            $result = $this->EmailSends->make($genCode);
            $this->assertEquals($expId, $result);

            // Check second is not blocked.
            $this->assertEquals($expId + 1, $this->EmailSends->make($genCode));

            // Check third is not blocked
            $this->assertEquals($expId + 2, $this->EmailSends->make($genCode));
        }
    }
}
