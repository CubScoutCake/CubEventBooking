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
        'app.Allergies',
        'app.ApplicationStatuses',
        'app.ApplicationsAttendees',
        'app.Applications',
        'app.AttendeesAllergies',
        'app.Attendees',
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
        'app.InvoicesPayments',
        'app.Invoices',
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
        'app.TaskTypes',
        'app.Tasks',
        'app.Tokens',
        'app.Users',
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
}
