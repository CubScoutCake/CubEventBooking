<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

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
        'app.payments',
        'app.invoices_payments',
        'app.invoices',
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.section_types',
        'app.sections',
        'app.auth_roles',
        'app.password_states',
        'app.applications',
        'app.application_statuses',
        'app.events',
        'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.event_types',
        'app.reservations',
        'app.reservation_statuses',
        'app.attendees',
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
                'x_value' => 1,
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
