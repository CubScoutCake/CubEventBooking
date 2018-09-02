<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailSendsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailSendsTable Test Case
 */
class EmailSendsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailSendsTable
     */
    public $EmailSends;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_sends',
        'app.email_response_types',
        'app.users',
        'app.password_states',
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
        'app.notification_types',
        'app.email_responses',
        'app.tokens'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailSends') ? [] : ['className' => 'App\Model\Table\EmailSendsTable'];
        $this->EmailSends = TableRegistry::get('EmailSends', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailSends);

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
