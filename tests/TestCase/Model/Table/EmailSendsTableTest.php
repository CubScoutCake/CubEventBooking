<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailSendsTable;
use Cake\I18n\Time;
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
        $config = TableRegistry::exists('EmailSends') ? [] : ['className' => 'App\Model\Table\EmailSendsTable'];
        $this->EmailSends = TableRegistry::get('EmailSends', $config);
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
        $now = Time::getTestNow();
        $good = [
            'sent' => $now,
            'message_id' => 'Lorem ipsum dolor sit amet',
            'user_id' => 1,
            'subject' => 'Lorem ipsum dolor sit amet',
            'routing_domain' => 'Lorem ipsum dolor sit amet',
            'from_address' => 'Lorem ipsum dolor sit amet',
            'friendly_from' => 'Lorem ipsum dolor sit amet',
            'notification_type_id' => 1,
            'notification_id' => 1,
            'deleted' => null
        ];

        return $good;
    }

    /**
     * Test initialize method
     *
     * @return void
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
                $this->assertInstanceOf('Cake\I18n\Time', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'message_id' => 'Lorem ipsum dolor sit amet',
            'user_id' => 1,
            'subject' => 'Lorem ipsum dolor sit amet',
            'routing_domain' => 'Lorem ipsum dolor sit amet',
            'from_address' => 'Lorem ipsum dolor sit amet',
            'friendly_from' => 'Lorem ipsum dolor sit amet',
            'notification_type_id' => 1,
            'notification_id' => 1,
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

        $required = [
            'sent',
            'message_id',
            'user_id',
            'subject',
            'routing_domain',
            'from_address',
            'friendly_from',
            'notification_type_id',
            'notification_id',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->EmailSends->newEntity($reqArray);
            $this->assertFalse($this->EmailSends->save($new));
        }

        $empties = [
            'sent',
            'message_id',
            'user_id',
            'subject',
            'routing_domain',
            'from_address',
            'friendly_from',
            'notification_type_id',
            'notification_id',
        ];

        foreach ($empties as $empty) {
            $reqArray = $good;
            $reqArray[$empty] = '';
            $new = $this->EmailSends->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));
        }

        $notEmpties = [
            'sent',
            'message_id',
            'user_id',
            'subject',
            'routing_domain',
            'from_address',
            'friendly_from',
            'notification_type_id',
            'notification_id',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->EmailSends->newEntity($reqArray);
            $this->assertFalse($this->EmailSends->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // EmailSend Type Exists
        $values = $this->getGood();

        $types = $this->EmailSends->EmailSendTypes->find('list')->toArray();

        $type = max(array_keys($types));

        $values['email_response_type_id'] = $type;
        $new = $this->EmailSends->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));

        $values['email_response_type_id'] = $type + 1;
        $new = $this->EmailSends->newEntity($values);
        $this->assertFalse($this->EmailSends->save($new));

        // Email Send Exists
        $values = $this->getGood();

        $types = $this->EmailSends->EmailSends->find('list')->toArray();

        $type = max(array_keys($types));

        $values['email_send_id'] = $type;
        $new = $this->EmailSends->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailSend', $this->EmailSends->save($new));

        $values['email_send_id'] = $type + 1;
        $new = $this->EmailSends->newEntity($values);
        $this->assertFalse($this->EmailSends->save($new));
    }
}
