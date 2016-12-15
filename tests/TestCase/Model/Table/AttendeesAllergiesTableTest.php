<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendeesAllergiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendeesAllergiesTable Test Case
 */
class AttendeesAllergiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendeesAllergiesTable
     */
    public $AttendeesAllergies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendees_allergies',
        'app.attendees',
        'app.allergies',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AttendeesAllergies') ? [] : ['className' => 'App\Model\Table\AttendeesAllergiesTable'];
        $this->AttendeesAllergies = TableRegistry::get('AttendeesAllergies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttendeesAllergies);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
