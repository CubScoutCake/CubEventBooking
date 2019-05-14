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
        'app.tokens',
        'app.users',
        'app.roles',
        'app.sections',
        'app.section_types',
        'app.scoutgroups',
        'app.districts',
        'app.password_states',
        'app.settings',
        'app.setting_types',
        'app.event_types',
        'app.auth_roles',
        'app.notifications',
        'app.notification_types',
        'app.email_sends',
        'app.email_responses',
        'app.email_response_types'
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
        $response = $this->Password->sendReset(1);
        $this->assertTrue($response);
    }
}
