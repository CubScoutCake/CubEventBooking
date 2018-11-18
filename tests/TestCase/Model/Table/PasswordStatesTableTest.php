<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PasswordStatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PasswordStatesTable Test Case
 */
class PasswordStatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PasswordStatesTable
     */
    public $PasswordStates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.password_states',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PasswordStates') ? [] : ['className' => 'App\Model\Table\PasswordStatesTable'];
        $this->PasswordStates = TableRegistry::get('PasswordStates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PasswordStates);

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
