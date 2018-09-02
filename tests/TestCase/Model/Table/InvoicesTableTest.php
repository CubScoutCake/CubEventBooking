<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoicesTable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\InvoicesTable Test Case
 */
class InvoicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoicesTable
     */
    public $Invoices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoices',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.settingtypes',
        'app.discounts',
        'app.password_states',
        'app.auth_roles',
        'app.sections',
        'app.section_types',
        'app.notes',
        'app.event_types',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Invoices') ? [] : ['className' => 'App\Model\Table\InvoicesTable'];
        $this->Invoices = TableRegistry::get('Invoices', $config);

        $now = new Time('2016-12-26 23:22:30');
        Time::setTestNow($now);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Invoices);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $timeNow = Time::now();

        $query = $this->Invoices->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'id' => 1,
                'user_id' => 1,
                'application_id' => 1,
                'value' => 1,
                'created' => $timeNow,
                'modified' => $timeNow,
                'paid' => 1,
                'initialvalue' => 1,
                'deleted' => null
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'application_id' => 3,
                'value' => 1,
                'created' => $timeNow,
                'modified' => $timeNow,
                'paid' => 1,
                'initialvalue' => 1,
                'deleted' => null
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
     * Test findOwnedBy method
     *
     * @return void
     */
    public function testFindOwnedBy()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findOutstanding method
     *
     * @return void
     */
    public function testFindOutstanding()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUnpaid method
     *
     * @return void
     */
    public function testFindUnpaid()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUnarchived method
     *
     * @return void
     */
    public function testFindUnarchived()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
