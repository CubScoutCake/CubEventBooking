<?php
namespace App\Test\TestCase\Shell;

use App\Shell\DatabaseShell;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Shell\DatabaseShell Test Case
 */
class DatabaseShellTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.password_states',
        'app.roles',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.auth_roles',
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
        $this->Database->password();

        $users = TableRegistry::get('Users');

        $unHashed = 'TestMe';

        $default = $users->findByUsername('Test')->first();
        $password = $default->password;

        $this->assertNotEquals($unHashed, $password);
    }
}
