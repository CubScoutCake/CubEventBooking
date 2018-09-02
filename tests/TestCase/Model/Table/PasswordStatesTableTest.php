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
        'app.users',
        'app.roles',
        'app.attendees',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.applications', 'app.application_statuses',
        'app.events', 'app.event_statuses',
        'app.settings',
        'app.setting_types',
        'app.discounts',
        'app.event_types',
        'app.logistics',
        'app.parameters',
        'app.parameter_sets',
        'app.params',
        'app.logistic_items',
        'app.prices',
        'app.item_types',
        'app.invoice_items',
        'app.invoices',
        'app.notes',
        'app.payments',
        'app.invoices_payments',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types'
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
