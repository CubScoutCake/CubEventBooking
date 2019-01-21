<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParamsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\ParamsTable Test Case
 */
class ParamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParamsTable
     */
    public $Params;

    public $fixtures = [
        'app.parameters',
        'app.parameter_sets',
        'app.params',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Params') ? [] : ['className' => 'App\Model\Table\ParamsTable'];
        $this->Params = TableRegistry::get('Params', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Params);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->Params->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'parameter_id' => 1,
                'constant' => 'Lorem ipsum dolor sit amet'
            ],
        ];

        $this->assertEquals($expected, $result);
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
