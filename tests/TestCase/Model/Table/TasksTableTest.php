<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TasksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * App\Model\Table\TasksTable Test Case
 */
class TasksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TasksTable
     */
    public $Tasks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
        'app.notification_types',
        'app.notifications',
        'app.application_statuses',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.event_statuses',
        'app.discounts',
        'app.events',
        'app.prices',
        'app.applications',
        'app.task_types',
        'app.tasks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Tasks') ? [] : ['className' => TasksTable::class];
        $this->Tasks = TableRegistry::getTableLocator()->get('Tasks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tasks);

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
            'task_type_id' => 1,
            'user_id' => 1,
            'completed' => false,
            'date_completed' => null,
            'completed_by_user_id' => 1,
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
        $actual = $this->Tasks->get(1)->toArray();

        $dates = [
            'created',
            'modified',
            'date_completed',
        ];

        foreach ($dates as $date) {
            $dateValue = $actual[$date];
            if (!is_null($dateValue)) {
                $this->assertInstanceOf('Cake\I18n\FrozenTime', $dateValue);
            }
            unset($actual[$date]);
        }

        $expected = [
            'id' => 1,
            'task_type_id' => 1,
            'user_id' => 1,
            'completed' => false,
            'completed_by_user_id' => null,
        ];
        $this->assertEquals($expected, $actual);

        $count = $this->Tasks->find('all')->count();
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

        $new = $this->Tasks->newEntity($good);
        $this->assertInstanceOf('App\Model\Entity\Task', $this->Tasks->save($new));

        $required = [
            'task_type_id',
            'user_id',
        ];

        foreach ($required as $require) {
            $reqArray = $this->getGood();
            unset($reqArray[$require]);
            $new = $this->Tasks->newEntity($reqArray);
            $this->assertFalse($this->Tasks->save($new));
        }

        $notEmpties = [
            'completed',
        ];

        foreach ($notEmpties as $not_empty) {
            $reqArray = $this->getGood();
            $reqArray[$not_empty] = '';
            $new = $this->Tasks->newEntity($reqArray);
            $this->assertFalse($this->Tasks->save($new));
        }

        $empties = [
            'completed_by_user_id',
        ];

        foreach ($empties as $empty) {
            $reqArray = $good;
            $reqArray[$empty] = null;
            $new = $this->Tasks->newEntity($reqArray);
            $this->assertInstanceOf('App\Model\Entity\Task', $this->Tasks->save($new));
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        // Task Type Exists
        $values = $this->getGood();

        $types = $this->Tasks->TaskTypes->find('list')->toArray();

        $type = max(array_keys($types));

        $values['task_type_id'] = $type;
        $new = $this->Tasks->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Task', $this->Tasks->save($new));

        $values['task_type_id'] = $type + 1;
        $new = $this->Tasks->newEntity($values);
        $this->assertFalse($this->Tasks->save($new));

        // User Exists
        $values = $this->getGood();

        $types = $this->Tasks->TaskTypes->find('list')->toArray();

        $type = max(array_keys($types));

        $values['task_type_id'] = $type;
        $new = $this->Tasks->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Task', $this->Tasks->save($new));

        $values['task_type_id'] = $type + 1;
        $new = $this->Tasks->newEntity($values);
        $this->assertFalse($this->Tasks->save($new));

        // Completing User Exists
        $values = $this->getGood();

        $types = $this->Tasks->CompletingUsers->find('list')->toArray();

        $type = max(array_keys($types));

        $values['completed_by_user_id'] = $type;
        $new = $this->Tasks->newEntity($values);
        $this->assertInstanceOf('App\Model\Entity\Task', $this->Tasks->save($new));

        $values['completed_by_user_id'] = $type + 1;
        $new = $this->Tasks->newEntity($values);
        $this->assertFalse($this->Tasks->save($new));
    }
}
