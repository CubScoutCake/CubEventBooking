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
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.notes',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.payments',
        'app.invoices_payments',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
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
