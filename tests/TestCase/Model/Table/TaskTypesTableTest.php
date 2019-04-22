<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaskTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\TaskTypesTable Test Case
 */
class TaskTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaskTypesTable
     */
    public $TaskTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TaskTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TaskTypes') ? [] : ['className' => TaskTypesTable::class];
        $this->TaskTypes = TableRegistry::getTableLocator()->get('TaskTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaskTypes);

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
            'task_type' => 'Lorem ' . random_int(11111, 99999) . ' dolor ' . random_int(11111, 99999) . ' amet',
            'shared_type' => 1,
            'type_icon' => 'Lorem ipsum d',
            'type_code' => 'L',
            'task_requirement' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
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
        $actual = $this->TaskTypes->get(1)->toArray();

        $expected = [
            'id' => 1,
            'task_type' => 'Lorem ipsum dolor sit amet',
            'shared_type' => 1,
            'type_icon' => 'Lorem ipsum d',
            'type_code' => 'L',
            'task_requirement' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->TaskTypes->find('all')->count();
        $this->assertEquals(2, $count);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $good = $this->getGood();

        $new = $this->TaskTypes->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\TaskType', $this->TaskTypes->save($new));

        $required = [
            'task_type',
            'shared_type',
            'type_icon',
            'type_code',
            'task_requirement',
        ];

        foreach ($required as $require) {
            $reqArray = $good;
            unset($reqArray[$require]);
            $new = $this->TaskTypes->newEntity($reqArray);
            $this->assertFalse($this->TaskTypes->save($new));
        }

        $empties = [
        ];

        foreach ($empties as $empty) {
            $reqArray = $good;
            $reqArray[$empty] = '';
            $new = $this->TaskTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\TaskType', $this->TaskTypes->save($new));
        }

        $notEmpties = [
            'task_type',
            'shared_type',
            'type_icon',
            'type_code',
            'task_requirement',
        ];

        foreach ($notEmpties as $notEmpty) {
            $reqArray = $good;
            $reqArray[$notEmpty] = '';
            $new = $this->TaskTypes->newEntity($reqArray);
            $this->assertFalse($this->TaskTypes->save($new));
        }

        $maxLengths = [
            'task_type' => 255,
            'type_icon' => 15,
            'type_code' => 3,
        ];

        $string = hash('sha512', Security::randomBytes(64));
        $string .= $string;
        $string .= $string;

        foreach ($maxLengths as $maxField => $maxLength) {
            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength);
            $new = $this->TaskTypes->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\TaskType', $this->TaskTypes->save($new));

            $reqArray = $this->getGood();
            $reqArray[$maxField] = substr($string, 1, $maxLength + 1);
            $new = $this->TaskTypes->newEntity($reqArray);
            $this->assertFalse($this->TaskTypes->save($new));
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

        $existing = $this->TaskTypes->get(1)->toArray();

        $values['task_type'] = 'My new Camp Role Type';
        $new = $this->TaskTypes->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\TaskType', $this->TaskTypes->save($new));

        $values['task_type'] = $existing['task_type'];
        $new = $this->TaskTypes->newEntity($values);
        $this->assertFalse($this->TaskTypes->save($new));
    }
}
