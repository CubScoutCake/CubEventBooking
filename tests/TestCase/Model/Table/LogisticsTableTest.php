<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Entity\LogisticItem;
use App\Model\Table\LogisticsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\LogisticsTable Test Case
 */
class LogisticsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LogisticsTable
     */
    public $Logistics;

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
        $config = TableRegistry::getTableLocator()->exists('Logistics') ? [] : ['className' => LogisticsTable::class];
        $this->Logistics = TableRegistry::getTableLocator()->get('Logistics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logistics);

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
            'event_id' => 2,
            'header' => 'Lorem ipsum dolor sit amet',
            'text' => 'Lorem ipsum dolor sit amet',
            'parameter_id' => 1,
            'variable_max_values' => '',
            'max_value' => 1
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
        $actual = $this->Logistics->get(1)->toArray();

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
            'event_id' => 3,
            'header' => 'Lorem ipsum dolor sit amet',
            'text' => 'Lorem ipsum dolor sit amet',
            'parameter_id' => 1,
            'variable_max_values' => [
                1 => [
                    'limit' => 3,
                ],
                2 => [
                    'limit' => 2,
                ]
            ],
            'max_value' => 1
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Logistics->find('all')->count();
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

        $new = $this->Logistics->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\Logistic', $this->Logistics->save($new));

        $required = [
            'header',
            'text',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Logistics->newEntity($reqArray);
            $this->assertFalse($this->Logistics->save($new));
        }

        $notEmpties = [
            'header',
        ];

        foreach ($notEmpties as $not_empty) {
            $reqArray = $this->getGood();
            $reqArray[$not_empty] = '';
            $new = $this->Logistics->newEntity($reqArray);
            $this->assertFalse($this->Logistics->save($new));
        }

        $maxLengths = [
            'header' => 45,
            'text' => 999,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;
        if (max($maxLengths) > 255) {
            $string .= $string;
            $string .= $string;
            $string .= $string;
        }

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->Logistics->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Logistic', $this->Logistics->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->Logistics->newEntity($reqArray);
            $this->assertFalse($this->Logistics->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Parameter Exists
        $values = $this->getGood();

        $parameters = $this->Logistics->Parameters->find('list')->toArray();

        $parameter = max(array_keys($parameters));

        $values['parameter_id'] = $parameter;
        $new = $this->Logistics->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Logistic', $this->Logistics->save($new));

        $values['parameter_id'] = $parameter + 1;
        $new = $this->Logistics->newEntity($values);
        $this->assertFalse($this->Logistics->save($new));

        // Event Exists
        $values = $this->getGood();

        $events = $this->Logistics->Events->find('list')->toArray();

        $event = max(array_keys($events));

        $values['event_id'] = $event;
        $new = $this->Logistics->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Logistic', $this->Logistics->save($new));

        $values['event_id'] = $event + 1;
        $new = $this->Logistics->newEntity($values);
        $this->assertFalse($this->Logistics->save($new));
    }

    /**
     * Test parseLogisticAvailability method
     *
     * @return void
     */
    public function testParseLogisticAvailability()
    {
        // Initial Processing
        $before = $this->Logistics->get(1);
        $this->assertEquals(1, $before->max_value);
        $this->assertEquals([1 => ['limit' => 3], 2 => ['limit' => 2]], $before->variable_max_values);

        $this->Logistics->parseLogisticAvailability(1);

        $after = $this->Logistics->get(1);
        $this->assertEquals(5, $after->max_value);

        $expected = [
            1 => [
                'limit' => 3,
                'current' => 1,
                'remaining' => 2
            ],
            2 => [
                'limit' => 2,
                'current' => 0,
                'remaining' => 2
            ]
        ];
        $this->assertEquals($expected, $after->variable_max_values);

        $newBooking = $this->Logistics->LogisticItems->newEntity([
            'reservation_id' => 1,
            'logistic_id' => 1,
            'param_id' => 1,
        ]);
        $this->assertInstanceOf(LogisticItem::class, $this->Logistics->LogisticItems->save($newBooking));

        $newBooking = $this->Logistics->LogisticItems->newEntity([
            'reservation_id' => 1,
            'logistic_id' => 1,
            'param_id' => 2,
        ]);
        $this->assertInstanceOf(LogisticItem::class, $this->Logistics->LogisticItems->save($newBooking));

        $booked = $this->Logistics->get(1);
        $expected = [
            1 => [
                'limit' => 3,
                'current' => 2,
                'remaining' => 1
            ],
            2 => [
                'limit' => 2,
                'current' => 1,
                'remaining' => 1
            ]
        ];
        $this->assertEquals($expected, $booked->variable_max_values);
    }

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
