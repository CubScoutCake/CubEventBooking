<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\DistrictAuthBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\DistrictAuthBehavior Test Case
 */
class DistrictAuthBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\DistrictAuthBehavior
     */
    public $DistrictAuth;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        //$this->DistrictAuth = new DistrictAuthBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DistrictAuth);

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
