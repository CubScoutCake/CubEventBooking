<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PasswordComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PasswordComponent Test Case
 *
 * @property PasswordComponent $Password
 * @property bool $travisPass
 */
class PasswordComponentTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Tokens',
        'app.Users',
        'app.Roles',
        'app.Sections',
        'app.SectionTypes',
        'app.Scoutgroups',
        'app.Districts',
        'app.PasswordStates',
        'app.Settings',
        'app.SettingTypes',
        'app.EventTypes',
        'app.AuthRoles',
        'app.Notifications',
        'app.NotificationTypes',
        'app.EmailSends',
        'app.EmailResponses',
        'app.EmailResponseTypes'
    ];

    /**
     * Test subject
     *
     * @var \App\Controller\Component\PasswordComponent
     */
    public $Password;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Password = new PasswordComponent($registry);

        $this->travisPass = Configure::read('travis');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Password);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testSendReset()
    {
        if ($this->travisPass) {
            $this->markTestSkipped('Skipped for Travis until Mocked.');
        }

        $response = $this->Password->sendReset(1);
        $this->assertTrue($response);
    }
}
