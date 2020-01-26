<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScoutgroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\ScoutgroupsTable Test Case
 */
class ScoutgroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScoutgroupsTable
     */
    public $Scoutgroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.districts',
        'app.scoutgroups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Scoutgroups') ? [] : ['className' => ScoutgroupsTable::class];
        $this->Scoutgroups = TableRegistry::getTableLocator()->get('Scoutgroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scoutgroups);

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
        $rand = random_int(111, 9999999);
        $good = [
            'scoutgroup' => $rand . 'th Letchworth',
            'district_id' => 1,
            'number_stripped' => $rand,
            'deleted' => null,
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
        $actual = $this->Scoutgroups->get(1)->toArray();

        $expected = [
            'id' => 1,
            'scoutgroup' => '12th Letchworth',
            'district_id' => 1,
            'number_stripped' => 1,
            'deleted' => null,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Scoutgroups->find('all')->count();
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

        $new = $this->Scoutgroups->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\Scoutgroup', $this->Scoutgroups->save($new));

        $required = [
            'scoutgroup',
        ];

        foreach ($required as $require) {
            $reqArray = $good;
            unset($reqArray[$require]);
            $new = $this->Scoutgroups->newEntity($reqArray);
            $this->assertFalse($this->Scoutgroups->save($new));
        }

        $empties = [
        ];

        foreach ($empties as $empty) {
            $reqArray = $good;
            $reqArray[$empty] = '';
            $new = $this->Scoutgroups->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Scoutgroup', $this->Scoutgroups->save($new));
        }

        $notEmpties = [
            'scoutgroup',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $good;
            $reqArray[$notEmpty] = '';
            $new = $this->Scoutgroups->newEntity($reqArray);
            $this->assertFalse($this->Scoutgroups->save($new));
        }

        $maxLengths = [
            'scoutgroup' => 255,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->Scoutgroups->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Scoutgroup', $this->Scoutgroups->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->Scoutgroups->newEntity($reqArray);
            $this->assertFalse($this->Scoutgroups->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Unique Scoutgroup
        $values = $this->getGood();

        $existing = $this->Scoutgroups->get(1)->toArray();

        $values['scoutgroup'] = 'My new Camp Role Type';
        $new = $this->Scoutgroups->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Scoutgroup', $this->Scoutgroups->save($new));

        $values['scoutgroup'] = $existing['scoutgroup'];
        $new = $this->Scoutgroups->newEntity($values);
        $this->assertFalse($this->Scoutgroups->save($new));

        // Email Send Exists
        $values = $this->getGood();

        $sends = $this->Scoutgroups->Districts->find('list')->toArray();

        $send = max(array_keys($sends));

        $values['district_id'] = $send;
        $new = $this->Scoutgroups->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Scoutgroup', $this->Scoutgroups->save($new));

        $values['district_id'] = $send + 1;
        $new = $this->Scoutgroups->newEntity($values);
        $this->assertFalse($this->Scoutgroups->save($new));
    }
}
