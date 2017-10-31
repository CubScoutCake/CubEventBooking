<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ScoutManagerComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ScoutManagerComponent Test Case
 */
class ScoutManagerComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ScoutManagerComponent
     */
    public $ScoutManager;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ScoutManager = new ScoutManagerComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ScoutManager);

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

    public function testLinkUser()
    {
    	$authArray = [
    		'osm_email' => 'jacob@4thletchworth.com',
    		'osm_password' => 'Rho9Sigma'
	    ];

    	$component = $this->ScoutManager->linkUser($authArray);

    	$this->assertTrue($component);
    }
}
