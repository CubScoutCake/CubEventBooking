<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\ApplicationStatusesTable Test Case
 */
class ApplicationStatusesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicationStatusesTable
     */
    public $ApplicationStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ApplicationStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApplicationStatuses') ? [] : ['className' => ApplicationStatusesTable::class];
        $this->ApplicationStatuses = TableRegistry::getTableLocator()->get('ApplicationStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicationStatuses);

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
            'application_status' => 'Status ' . random_int(111, 999) . ' ' . random_int(111, 999),
            'active' => true,
            'no_money' => true,
            'reserved' => false,
            'attendees_added' => false,
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
        $actual = $this->ApplicationStatuses->get(1)->toArray();

        $expected = [
            'id' => 1,
            'application_status' => 'New',
            'active' => 1,
            'no_money' => 1,
            'reserved' => 0,
            'attendees_added' => 0,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->ApplicationStatuses->find('all')->count();
        $this->assertEquals(5, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->ApplicationStatuses->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\ApplicationStatus', $this->ApplicationStatuses->save($new));

        $required = [
            'application_status',
            'active',
            'no_money',
            'reserved',
            'attendees_added',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->ApplicationStatuses->newEntity($reqArray);
            $this->assertFalse($this->ApplicationStatuses->save($new));
        }

        $notRequired = [
        ];

        foreach ($notRequired as $notRequire) {
            $reqArray = $this->getGood();
            unset($reqArray[$notRequire]);
            $new = $this->ApplicationStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\ApplicationStatus', $this->ApplicationStatuses->save($new));
        }

        $empties = [
        ];

        foreach ($empties as $empty) {
            $reqArray = $this->getGood();
            $reqArray[$empty] = '';
            $new = $this->ApplicationStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\ApplicationStatus', $this->ApplicationStatuses->save($new));
        }

        $notEmpties = [
            'application_status',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $this->getGood();
            $reqArray[$notEmpty] = '';
            $new = $this->ApplicationStatuses->newEntity($reqArray);
            $this->assertFalse($this->ApplicationStatuses->save($new));
        }

        $maxLengths = [
            'application_status' => 255,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->ApplicationStatuses->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\ApplicationStatus', $this->ApplicationStatuses->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->ApplicationStatuses->newEntity($reqArray);
            $this->assertFalse($this->ApplicationStatuses->save($new));
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

        $existing = $this->ApplicationStatuses->get(1)->toArray();

        $values['application_status'] = 'My new Camp Role Type';
        $new = $this->ApplicationStatuses->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\ApplicationStatus', $this->ApplicationStatuses->save($new));

        $values['application_status'] = $existing['application_status'];
        $new = $this->ApplicationStatuses->newEntity($values);
        $this->assertFalse($this->ApplicationStatuses->save($new));
    }

    /**
     * Test installBaseCapabilities method
     *
     * @return void
     */
    public function testInstallBaseStatuses()
    {
        $before = $this->ApplicationStatuses->find('all')->count();

        $installed = $this->ApplicationStatuses->installBaseStatuses();

        $this->assertNotEquals($before, $installed);
        $this->assertNotEquals(0, $installed);

        $after = $this->ApplicationStatuses->find('all')->count();
        $this->assertTrue($after > $before);
    }
}
