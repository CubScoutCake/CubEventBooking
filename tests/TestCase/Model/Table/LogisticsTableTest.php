<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogisticsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogisticsTable Test Case
 */
class LogisticsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogisticsTable
     */
    public $Logistics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.events',
        'app.event_statuses',
        'app.event_types',
        'app.settings',
        'app.password_states',
        'app.setting_types',
        'app.users',
        'app.roles',
        'app.discounts',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Logistics') ? [] : ['className' => LogisticsTable::class];
        $this->Logistics = TableRegistry::getTableLocator()->get('Logistics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logistics);

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
