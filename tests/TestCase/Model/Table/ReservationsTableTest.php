<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationsTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\ReservationsTable Test Case
 */
class ReservationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationsTable
     */
    public $Reservations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reservations',
        'app.events',
        'app.event_statuses',
        'app.event_types',
        'app.discounts',
        'app.notifications',
        'app.notification_types',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.password_states',
        'app.districts',
        'app.champions',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
        'app.settings',
        'app.setting_types',
        'app.reservation_statuses',
        'app.attendees',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Reservations') ? [] : ['className' => ReservationsTable::class];
        $this->Reservations = TableRegistry::getTableLocator()->get('Reservations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Reservations);

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
            'event_id' => 3,
            'user_id' => 1,
            'attendee_id' => 1,
            'reservation_status_id' => 1,
            'reservation_code' => 'PLX'
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
        $actual = $this->Reservations->get(1)->toArray();

        $dates = [
            'modified',
            'created',
            'deleted',
            'expires',
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
            'event_id' => 3,
            'user_id' => 1,
            'attendee_id' => 1,
            'reservation_status_id' => 1,
            'reservation_code' => 'PLX'
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Reservations->find('all')->count();
        $this->assertEquals(1, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->Reservations->newEntity($good);
        debug($new);
        $this->assertInstanceOf('App\Model\Entity\Reservation', $this->Reservations->save($new));

        $required = [
            'user_id',
            'attendee_id',
            'event_id',
            'reservation_status_id',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Reservations->newEntity($reqArray);
            $this->assertFalse($this->Reservations->save($new));
        }

        $notEmpties = [
            'user_id',
            'attendee_id',
            'event_id',
            'reservation_status_id',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->Reservations->newEntity($reqArray);
            $this->assertFalse($this->Reservations->save($new));
        }

        $maxLengths = [
            'reservation_code' => 3,
        ];

        $string = hash('sha512', Security::randomBytes(64));

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->Reservations->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Reservation', $this->Reservations->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->Reservations->newEntity($reqArray);
            $this->assertFalse($this->Reservations->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Reservation Status Exists
        $values = $this->getGood();

        $types = $this->Reservations->ReservationStatuses->find('list')->toArray();

        $type = max(array_keys($types));

        $values['reservation_status_id'] = $type;
        $new = $this->Reservations->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Reservation', $this->Reservations->save($new));

        $values['reservation_status_id'] = $type + 1;
        $new = $this->Reservations->newEntity($values);
        $this->assertFalse($this->Reservations->save($new));

        // User Exists
        $values = $this->getGood();

        $types = $this->Reservations->Users->find('list')->toArray();

        $type = max(array_keys($types));

        $values['user_id'] = $type;
        $new = $this->Reservations->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Reservation', $this->Reservations->save($new));

        $values['user_id'] = $type + 1;
        $new = $this->Reservations->newEntity($values);
        $this->assertFalse($this->Reservations->save($new));

        // Event Exists
        $values = $this->getGood();

        $types = $this->Reservations->Events->find('list')->toArray();

        $type = max(array_keys($types));

        $values['event_id'] = $type;
        $new = $this->Reservations->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Reservation', $this->Reservations->save($new));

        $values['event_id'] = $type + 1;
        $new = $this->Reservations->newEntity($values);
        $this->assertFalse($this->Reservations->save($new));

        // Attendees
        $values = $this->getGood();

        $types = $this->Reservations->Attendees->find('list')->toArray();

        $type = max(array_keys($types));

        $values['attendee_id'] = $type;
        $new = $this->Reservations->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Reservation', $this->Reservations->save($new));

        $values['attendee_id'] = $type + 1;
        $new = $this->Reservations->newEntity($values);
        $this->assertFalse($this->Reservations->save($new));
    }
}
