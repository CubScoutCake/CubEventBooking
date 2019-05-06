<?php
namespace App\Test\TestCase\Shell;

use App\Shell\DatabaseShell;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\IntegrationTestTrait;
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
        'app.Sessions',
        'app.Districts',
        'app.Scoutgroups',
        'app.SectionTypes',
        'app.Sections',
        'app.PasswordStates',
        'app.AuthRoles',
        'app.ItemTypes',
        'app.Roles',
        'app.Users',
        'app.NotificationTypes',
        'app.Notifications',
        'app.ApplicationStatuses',
        'app.SettingTypes',
        'app.Settings',
        'app.EventTypes',
        'app.EventStatuses',
        'app.Discounts',
        'app.Events',
        'app.Prices',
        'app.Applications',
        'app.TaskTypes',
        'app.Tasks',
        'app.Attendees',
        'app.ApplicationsAttendees',
        'app.Allergies',
        'app.AttendeesAllergies',
        'app.ReservationStatuses',
        'app.Reservations',
        'app.Invoices',
        'app.InvoiceItems',
        'app.Payments',
        'app.InvoicesPayments',
        'app.Notes',
        'app.ParameterSets',
        'app.Parameters',
        'app.Params',
        'app.Logistics',
        'app.LogisticItems',
        'app.EmailSends',
        'app.Tokens',
        'app.EmailResponseTypes',
        'app.EmailResponses',
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
