<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParameterSetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParameterSetsTable Test Case
 */
class ParameterSetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParameterSetsTable
     */
    public $ParameterSets;

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
        'app.parameter_sets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ParameterSets') ? [] : ['className' => 'App\Model\Table\ParameterSetsTable'];
        $this->ParameterSets = TableRegistry::get('ParameterSets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParameterSets);

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
