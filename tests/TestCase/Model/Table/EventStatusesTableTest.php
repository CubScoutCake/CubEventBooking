<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

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
        'app.event_statuses',
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
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
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
}
