<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendeesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\AttendeesTable Test Case
 */
class AttendeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendeesTable
     */
    public $Attendees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.users',
        'app.roles',
        'app.password_states',
        'app.scoutgroups',
        'app.districts',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Attendees') ? [] : ['className' => 'App\Model\Table\AttendeesTable'];
        $this->Attendees = TableRegistry::get('Attendees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Attendees);

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

    /**
     * Test isOwnedBy method
     *
     * @return void
     */
    public function testIsOwnedBy()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findCountIncluded method
     *
     * @return void
     */
    public function testFindCountIncluded()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findOsm method
     *
     * @return void
     */
    public function testFindOsm()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUnattached method
     *
     * @return void
     */
    public function testFindUnattached()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
