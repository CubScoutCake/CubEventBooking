<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReservationStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\ReservationStatusesTable Test Case
 */
class ReservationStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReservationStatusesTable
     */
    public $ReservationStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('ReservationStatuses') ? [] : ['className' => ReservationStatusesTable::class];
        $this->ReservationStatuses = TableRegistry::getTableLocator()->get('ReservationStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReservationStatuses);

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
            'reservation_status' => 'Status ' . random_int(111, 999) . ' ' . random_int(111, 999),
            'active' => true,
            'complete' => true,
            'cancelled' => false,
            'status_order' => random_int(0, 999),
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
        $actual = $this->ReservationStatuses->get(1)->toArray();

        $expected = [
            'id' => 1,
            'reservation_status' => 'Pending Payment',
            'active' => true,
            'complete' => false,
            'cancelled' => false,
            'status_order' => 1,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->ReservationStatuses->find('all')->count();
        $this->assertEquals(4, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->ReservationStatuses->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\ReservationStatus', $this->ReservationStatuses->save($new));

        $required = [
            'reservation_status',
            'active',
            'complete',
            'cancelled',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->ReservationStatuses->newEntity($reqArray);
            $this->assertFalse($this->ReservationStatuses->save($new));
        }

        $notRequired = [
        ];

        foreach ($notRequired as $notRequire) {
            $reqArray = $this->getGood();
            unset($reqArray[$notRequire]);
            $new = $this->ReservationStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\ReservationStatus', $this->ReservationStatuses->save($new));
        }

        $empties = [
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->ReservationStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\ReservationStatus', $this->ReservationStatuses->save($new));
        }

        $notEmpties = [
            'reservation_status',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->ReservationStatuses->newEntity($reqArray);
            $this->assertFalse($this->ReservationStatuses->save($new));
        }

        $maxLengths = [
            'reservation_status' => 255,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->ReservationStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\ReservationStatus', $this->ReservationStatuses->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->ReservationStatuses->newEntity($reqArray);
            $this->assertFalse($this->ReservationStatuses->save($new));
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

        $existing = $this->ReservationStatuses->get(1)->toArray();

        $values['reservation_status'] = 'My new Camp Role Type';
        $new = $this->ReservationStatuses->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\ReservationStatus', $this->ReservationStatuses->save($new));

        $values['reservation_status'] = $existing['reservation_status'];
        $new = $this->ReservationStatuses->newEntity($values);
        $this->assertFalse($this->ReservationStatuses->save($new));
    }

    /**
     * Test installBaseStatuses method
     *
     * @return void
     */
    public function testInstallBaseStatuses()
    {
        $before = $this->ReservationStatuses->find('all')->count();

        $installed = $this->ReservationStatuses->installBaseStatuses();

        $this->assertNotEquals($before, $installed);
        $this->assertNotEquals(0, $installed);

        $after = $this->ReservationStatuses->find('all')->count();
        $this->assertTrue($after > $before);
    }
}
