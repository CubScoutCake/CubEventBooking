<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationsAttendeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\ApplicationsAttendeesTable Test Case
 */
class ApplicationsAttendeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicationsAttendeesTable
     */
    public $ApplicationsAttendees;

    /**
     * Fixtures
     *
     * @var array
     *
    public $fixtures = [
        'app.applications_attendees',
        'app.applications',
        'app.attendees',
        'app.events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ApplicationsAttendees') ? [] : ['className' => 'App\Model\Table\ApplicationsAttendeesTable'];
        $this->ApplicationsAttendees = TableRegistry::get('ApplicationsAttendees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicationsAttendees);

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
