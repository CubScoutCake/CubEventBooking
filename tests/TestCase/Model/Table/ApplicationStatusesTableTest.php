<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicationStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicationStatusesTable Test Case
 */
class ApplicationStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicationStatusesTable
     */
    public $ApplicationStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applications', 'app.application_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.roles',
        'app.password_states',
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.users',
        'app.events', 'app.event_statuses',
        'app.event_types',
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
        $config = TableRegistry::getTableLocator()->exists('ApplicationStatuses') ? [] : ['className' => ApplicationStatusesTable::class];
        $this->ApplicationStatuses = TableRegistry::getTableLocator()->get('ApplicationStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicationStatuses);

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
