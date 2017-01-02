<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\usersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\usersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\usersTable
     */
    public $users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.roles',
        'app.scoutgroups',
        'app.districts',
        'app.champions',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
        'app.settings',
        'app.settingtypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('users') ? [] : ['className' => 'App\Model\Table\usersTable'];
        $this->users = TableRegistry::get('users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->users);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
