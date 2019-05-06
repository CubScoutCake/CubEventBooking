<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoicesPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\ModelLevel\Table\InvoicesPaymentsTable Test Case
 */
class InvoicesPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoicesPaymentsTable
     */
    public $InvoicesPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Payments',
        'app.InvoicesPayments',
        'app.Invoices',
        'app.Users',
        'app.Roles',
        'app.Scoutgroups',
        'app.Districts',
        'app.SectionTypes',
        'app.Sections',
        'app.AuthRoles',
        'app.PasswordStates',
        'app.Applications',
        'app.ApplicationStatuses',
        'app.Events',
        'app.EventStatuses',
        'app.Settings',
        'app.SettingTypes',
        'app.Discounts',
        'app.EventTypes',
        'app.Reservations',
        'app.ReservationStatuses',
        'app.Attendees',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoicesPayments') ? [] : ['className' => 'App\Model\Table\InvoicesPaymentsTable'];
        $this->InvoicesPayments = TableRegistry::get('InvoicesPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoicesPayments);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $query = $this->InvoicesPayments->find('all');

        $this->assertInstanceOf('Cake\ORM\Query', $query);
        $result = $query->enableHydration(false)->toArray();
        $expected = [
            [
                'invoice_id' => 1,
                'payment_id' => 1,
                'x_value' => 1
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
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
