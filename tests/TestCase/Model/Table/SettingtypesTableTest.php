<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingtypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\SettingtypesTable Test Case
 */
class SettingtypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SettingtypesTable
     */
    public $Settingtypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.settingtypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Settingtypes') ? [] : ['className' => 'App\Model\Table\SettingtypesTable'];
        $this->Settingtypes = TableRegistry::get('Settingtypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Settingtypes);

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
