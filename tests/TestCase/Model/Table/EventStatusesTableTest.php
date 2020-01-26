<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventStatusesTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\EventStatusesTable Test Case
 */
class EventStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventStatusesTable
     */
    public $EventStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EventStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EventStatuses') ? [] : ['className' => EventStatusesTable::class];
        $this->EventStatuses = TableRegistry::getTableLocator()->get('EventStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventStatuses);

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
            'event_status' => 'Status ' . random_int(111, 999) . ' ' . random_int(111, 999),
            'live' => true,
            'accepting_applications' => true,
            'spaces_full' => true,
            'pending_date' => true,
            'order' => 1,
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
        $actual = $this->EventStatuses->get(1)->toArray();

        $expected = [
            'id' => 1,
            'event_status' => 'Live',
            'live' => true,
            'accepting_applications' => true,
            'spaces_full' => true,
            'pending_date' => true,
            'status_order' => 1,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->EventStatuses->find('all')->count();
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

        $new = $this->EventStatuses->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\EventStatus', $this->EventStatuses->save($new));

        $required = [
            'event_status',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->EventStatuses->newEntity($reqArray);
            $this->assertFalse($this->EventStatuses->save($new));
        }

        $notRequired = [
            'live',
            'accepting_applications',
            'reserved',
            'spaces_full',
        ];

        foreach ($notRequired as $notRequire) {
            $reqArray = $this->getGood();
            unset($reqArray[$notRequire]);
            $new = $this->EventStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\EventStatus', $this->EventStatuses->save($new));
        }

        $empties = [
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->EventStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\EventStatus', $this->EventStatuses->save($new));
        }

        $notEmpties = [
            'event_status',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->EventStatuses->newEntity($reqArray);
            $this->assertFalse($this->EventStatuses->save($new));
        }

        $maxLengths = [
            'event_status' => 255,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->EventStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\EventStatus', $this->EventStatuses->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->EventStatuses->newEntity($reqArray);
            $this->assertFalse($this->EventStatuses->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $values = $this->getGood();

        $existing = $this->EventStatuses->get(1)->toArray();

        $values['event_status'] = 'My new Camp Role Type';
        $new = $this->EventStatuses->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\EventStatus', $this->EventStatuses->save($new));

        $values['event_status'] = $existing['event_status'];
        $new = $this->EventStatuses->newEntity($values);
        $this->assertFalse($this->EventStatuses->save($new));
    }

    /**
     * Test installBaseStatuses method
     *
     * @return void
     */
    public function testInstallBaseStatuses()
    {
        $before = $this->EventStatuses->find('all')->count();

        $installed = $this->EventStatuses->installBaseStatuses();

        $this->assertNotEquals($before, $installed);
        $this->assertNotEquals(0, $installed);

        $new = $before + $installed;
        $after = $this->EventStatuses->find('all')->count();

        $this->assertEquals($new, $after);
    }

    /**
     * Test installBaseStatuses method
     *
     * @return void
     */
    public function testFindCore()
    {
        $this->EventStatuses->installBaseStatuses();

        $before = $this->EventStatuses->find('all')->count();
        $core = $this->EventStatuses->find('core')->count();

        $difference = $before - $core;

        $this->assertEquals(1, $difference);

        $query = $this->EventStatuses->find('all');

        foreach (Configure::read('eventStatuses') as $baseStatus) {
            $query = $query->where(['event_status <>' => $baseStatus['event_status']]);
        }

        $this->assertEquals($difference, $query->count());
    }
}
