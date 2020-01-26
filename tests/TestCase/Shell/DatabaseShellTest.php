<?php
declare(strict_types=1);

namespace App\Test\TestCase\Shell;

use App\Shell\DatabaseShell;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\DatabaseShell Test Case
 */
class DatabaseShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

//    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sessions',
        'app.districts',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.password_states',
        'app.auth_roles',
        'app.item_types',
        'app.roles',
        'app.users',
        'app.notification_types',
        'app.notifications',
        'app.application_statuses',
        'app.setting_types',
        'app.settings',
        'app.event_types',
        'app.event_statuses',
        'app.discounts',
        'app.events',
        'app.prices',
        'app.applications',
        'app.task_types',
        'app.tasks',
        'app.attendees',
        'app.applications_attendees',
        'app.allergies',
        'app.attendees_allergies',
        'app.reservation_statuses',
        'app.reservations',
        'app.invoices',
        'app.invoice_items',
        'app.payments',
        'app.invoices_payments',
        'app.notes',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.logistics',
        'app.logistic_items',
        'app.email_sends',
        'app.tokens',
        'app.email_response_types',
        'app.email_responses',
    ];

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \App\Shell\DatabaseShell
     */
    public $Database;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->Database = new DatabaseShell($this->io);

        $this->useCommandRunner();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Database);

        parent::tearDown();
    }

    /**
     * Test build method
     *
     * @return void
     */
    public function testBuild()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test seed method
     *
     * @return void
     */
    public function testSeed()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test password method
     *
     * @return void
     */
    public function testPassword()
    {
        $this->markTestSkipped('to be rebuilt as command');

        $this->Database->password();

        $users = TableRegistry::getTableLocator()->get('Users');

        $unHashed = 'TestMe';

        $default = $users->findByUsername('Test')->first();
        $password = $default->password;

        $this->assertNotEquals($unHashed, $password);
    }

    /**
     * Test base method
     *
     * @return void
     */
    public function testBase()
    {
        $this->markTestSkipped('to be rebuilt as command');

        $this->exec('database base');

        $this->assertExitCode(0);

        $this->assertOutputContains('6 Event Statuses Installed.');
        $this->assertOutputContains('6 Application Statuses Installed.');
    }
}
