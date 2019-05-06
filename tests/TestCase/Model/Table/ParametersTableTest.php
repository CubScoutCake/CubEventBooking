<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParametersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\ParametersTable Test Case
 */
class ParametersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParametersTable
     */
    public $Parameters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Prices',
        'app.ItemTypes',
        'app.InvoiceItems',
        'app.Invoices',
        'app.Users',
        'app.Roles',
        'app.PasswordStates',
        'app.Attendees',
        'app.Sections',
        'app.SectionTypes',
        'app.Scoutgroups',
        'app.Districts',
        'app.Champions',
        'app.Applications', 'app.ApplicationStatuses',
        'app.Events', 'app.EventStatuses',
        'app.Settings',
        'app.SettingTypes',
        'app.Discounts',
        'app.Logistics',
        'app.Parameters',
        'app.ParameterSets',
        'app.Params',
        'app.LogisticItems',
        'app.Notes',
        'app.ApplicationsAttendees',
        'app.Allergies',
        'app.AttendeesAllergies',
        'app.AuthRoles',
        'app.Notifications',
        'app.NotificationTypes',
        'app.Payments',
        'app.InvoicesPayments',
        'app.EventTypes',
        'app.Reservations',
        'app.ReservationStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Parameters') ? [] : ['className' => ParametersTable::class];
        $this->Parameters = TableRegistry::getTableLocator()->get('Parameters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Parameters);

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
            'parameter' => 'Lorem ipsum dolor sit amet',
            'constant' => 'Lorem ipsum dolor sit amet',
            'set_id' => 1,
            'deleted' => null,
            'limited' => 1
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
        $actual = $this->Parameters->get(1)->toArray();

        $dates = [
            'deleted'
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
            'parameter' => 'Lorem ipsum dolor sit amet',
            'constant' => 'Lorem ipsum dolor sit amet',
            'set_id' => 1,
            'limited' => 1
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Parameters->find('all')->count();
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

        $new = $this->Parameters->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\Parameter', $this->Parameters->save($new));

        $required = [
            'parameter',
            'limited'
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Parameters->newEntity($reqArray);
            $this->assertFalse($this->Parameters->save($new));
        }

        $notEmpties = [
            'parameter',
            'limited',
            'constant'
        ];

        foreach ($notEmpties as $not_empty) {
            $reqArray = $this->getGood();
            $reqArray[$not_empty] = '';
            $new = $this->Parameters->newEntity($reqArray);
            $this->assertFalse($this->Parameters->save($new));
        }

        $maxLengths = [
            'constant' => 255,
            'parameter' => 45,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->Parameters->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Parameter', $this->Parameters->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->Parameters->newEntity($reqArray);
            $this->assertFalse($this->Parameters->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Parameter Set Exists
        $values = $this->getGood();

        $parameterSets = $this->Parameters->ParameterSets->find('list')->toArray();

        $parameterSet = max(array_keys($parameterSets));

        $values['set_id'] = $parameterSet;
        $new = $this->Parameters->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Parameter', $this->Parameters->save($new));

        $values['set_id'] = $parameterSet + 1;
        $new = $this->Parameters->newEntity($values);
        $this->assertFalse($this->Parameters->save($new));
    }
}
