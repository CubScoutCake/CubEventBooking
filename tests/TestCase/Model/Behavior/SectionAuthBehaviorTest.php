<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\SectionAuthBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\SectionAuthBehavior Test Case
 */
class SectionAuthBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\SectionAuthBehavior
     */
    public $SectionAuth;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        //$this->SectionAuth = new SectionAuthBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SectionAuth);

        parent::tearDown();
    }

    /**
     * Test findSameSection method
     *
     * @return void
     */
    public function testFindSameSection()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findUserSection method
     *
     * @return void
     */
    public function testFindUserSection()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findEventSection method
     *
     * @return void
     */
    public function testFindEventSection()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
