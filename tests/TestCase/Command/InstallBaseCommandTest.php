<?php
declare(strict_types=1);

namespace App\Test\TestCase\Command;

use Cake\Console\Command;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Class InstallBaseCommandTest
 *
 * @package App\Test\TestCase\Command
 * @uses \App\Command\InstallBaseCommand
 */
class InstallBaseCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.params',
        'app.Logistics',
        'app.LogisticItems',
        'app.EmailSends',
        'app.Tokens',
        'app.EmailResponseTypes',
        'app.EmailResponses',
        'app.Champions',
        'app.Sessions',
    ];

    /**
     * Setup Function
     */
    public function setUp()
    {
        parent::setUp();
        $this->useCommandRunner();
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testDescriptionOutput()
    {
        $this->exec('install_base --help');
        $this->assertOutputContains('Install Configuration Options.');
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testInstallAll()
    {
        $this->exec('install_base -a');
        $this->assertExitCode(Command::CODE_SUCCESS);

        $this->assertOutputContains('Capabilities Installed:');
        $this->assertOutputContains('File Types Installed:');
        $this->assertOutputContains('Notification Types Installed:');
        $this->assertOutputContains('Role Templates Installed:');
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testInstallCapabilities()
    {
        $this->exec('install_base -c');
        $this->assertExitCode(Command::CODE_SUCCESS);

        $this->assertOutputContains('Capabilities Installed:');
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testInstallFileTypes()
    {
        $this->exec('install_base -f');
        $this->assertExitCode(Command::CODE_SUCCESS);

        $this->assertOutputContains('File Types Installed:');
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testInstallNotificationTypes()
    {
        $this->exec('install_base -n');
        $this->assertExitCode(Command::CODE_SUCCESS);

        $this->assertOutputContains('Notification Types Installed:');
    }

    /**
     * Description Output
     *
     * @return void
     */
    public function testInstallRoleTemplates()
    {
        $this->exec('install_base -r');
        $this->assertExitCode(Command::CODE_SUCCESS);

        $this->assertOutputContains('Role Templates Installed:');
    }
}
