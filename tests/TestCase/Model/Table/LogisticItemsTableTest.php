<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogisticItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogisticItemsTable Test Case
 */
class LogisticItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogisticItemsTable
     */
    public $LogisticItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.logistic_items',
        'app.applications',
        'app.logistics',
        'app.params'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LogisticItems') ? [] : ['className' => LogisticItemsTable::class];
        $this->LogisticItems = TableRegistry::getTableLocator()->get('LogisticItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LogisticItems);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
