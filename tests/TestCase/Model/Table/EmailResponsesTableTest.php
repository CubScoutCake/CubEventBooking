<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailResponsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailResponsesTable Test Case
 */
class EmailResponsesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailResponsesTable
     */
    public $EmailResponses;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EmailResponses') ? [] : ['className' => EmailResponsesTable::class];
        $this->EmailResponses = TableRegistry::getTableLocator()->get('EmailResponses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailResponses);

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
        $good = [
            'email_send_id' => 1,
            'email_response_type_id' => 1,
            'link_clicked' => 'Lorem ipsum dolor sit amet',
            'ip_address' => 'Lorem ipsum dolor sit amet',
            'bounce_reason' => 'Lorem ipsum dolor sit amet',
            'message_size' => 1,
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
        $actual = $this->EmailResponses->get(1)->toArray();

        $dates = [
            'received',
            'created',
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
            'email_send_id' => 1,
            'email_response_type_id' => 1,
            'link_clicked' => 'Lorem ipsum dolor sit amet',
            'ip_address' => 'Lorem ipsum dolor sit amet',
            'bounce_reason' => 'Lorem ipsum dolor sit amet',
            'message_size' => 1,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->EmailResponses->find('all')->count();
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

        $new = $this->EmailResponses->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\EmailResponse', $this->EmailResponses->save($new));

        $required = [
            'email_send_id',
            'email_response_type_id',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->EmailResponses->newEntity($reqArray);
            $this->assertFalse($this->EmailResponses->save($new));
        }

        $empties = [
            'link_clicked',
            'ip_address',
            'bounce_reason',
            'message_size',
        ];

        foreach ($empties as $empty) {
            $reqArray = $good;
            $reqArray[$empty] = '';
            $new = $this->EmailResponses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\EmailResponse', $this->EmailResponses->save($new));
        }

        $notEmpties = [
            'received',
            'email_send_id',
            'email_response_type_id',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->EmailResponses->newEntity($reqArray);
            $this->assertFalse($this->EmailResponses->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // EmailResponse Type Exists
        $values = $this->getGood();

        $types = $this->EmailResponses->EmailResponseTypes->find('list')->toArray();

        $type = max(array_keys($types));

        $values['email_response_type_id'] = $type;
        $new = $this->EmailResponses->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailResponse', $this->EmailResponses->save($new));

        $values['email_response_type_id'] = $type + 1;
        $new = $this->EmailResponses->newEntity($values);
        $this->assertFalse($this->EmailResponses->save($new));

        // Email Send Exists
        $values = $this->getGood();

        $types = $this->EmailResponses->EmailSends->find('list')->toArray();

        $type = max(array_keys($types));

        $values['email_send_id'] = $type;
        $new = $this->EmailResponses->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EmailResponse', $this->EmailResponses->save($new));

        $values['email_send_id'] = $type + 1;
        $new = $this->EmailResponses->newEntity($values);
        $this->assertFalse($this->EmailResponses->save($new));
    }
}
