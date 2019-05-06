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
        'app.LogisticItems',
        'app.Applications',
        'app.ParameterSets',
        'app.Logistics',
        'app.Params',
        'app.Events',
        'app.EventStatuses',
        'app.EventTypes',
        'app.Settings',
        'app.PasswordStates',
        'app.SettingTypes',
        'app.Users',
        'app.Roles',
        'app.Discounts',
        'app.Sections',
        'app.SectionTypes',
        'app.Scoutgroups',
        'app.Districts',
        'app.AuthRoles',
        'app.Notifications',
        'app.NotificationTypes',
        'app.ApplicationStatuses',
        'app.Reservations',
        'app.Champions',
        'app.ReservationStatuses',
        'app.Attendees',
        'app.Parameters',
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
