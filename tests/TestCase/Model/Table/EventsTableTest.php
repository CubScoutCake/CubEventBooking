<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsTable
     */
    public $Events;

    /**
     * Fixtures
     *
     * @var array
     */

    public $fixtures = [
        'app.events',
        'app.settings',
        'app.settingtypes',
        'app.section_types',
        'app.sections',
        'app.discounts',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.auth_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Events') ? [] : ['className' => 'App\Model\Table\EventsTable'];
        $this->Events = TableRegistry::get('Events', $config);

        $now = new Time('2016-12-26 23:22:30');
        Time::setTestNow($now);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Events);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Events->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->count('*');

        $this->assertEquals(2, $result);
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUnarchived method
     *
     * @return void
     */
    public function testFindUnarchived()
    {
        $query = $this->Events->find('unarchived');
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->hydrate(false)->count('*');
        $firstResult = $query->first();
        $LastResult = $query->last();

        $this->assertEquals($firstResult['id'], $LastResult['id']);

        $this->assertEquals(1, $result);

        $dataExpected = ['id' => 3 ];

        $this->assertEquals($dataExpected['id'], $firstResult['id']);
    }

    public function testFindUpcoming()
    {
        $query = $this->Events->find('upcoming');
        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->first();
        $LastResult = $query->last();

        $this->assertEquals($result->id, $LastResult->id);
        $this->assertEquals($result->start_date, $LastResult->start_date);
        $this->assertEquals($result->end_date, $LastResult->end_date);
        $this->assertEquals($result->deposit_date, $LastResult->deposit_date);

        $startNow = Time::now();
        $startDate = $startNow->modify('+40 days');

        $endNow = Time::now();
        $endDate = $endNow->modify('+41 days');

        $depositNow = Time::now();
        $depositDate = $depositNow->modify('+20 days');

        $this->assertEquals($startDate, $result->start_date);
        $this->assertEquals($endDate, $result->end_date);
        $this->assertEquals($depositDate, $result->deposit_date);

        $now = Time::now();
        $badDate = $now->addDays(12);

        $this->assertNotEquals($badDate, $result->start_date);
        $this->assertNotEquals($badDate, $result->end_date);
        $this->assertNotEquals($badDate, $result->deposit_date);
    }
}
