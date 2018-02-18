<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ProgressComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ProgressComponent Test Case
 */
class ProgressComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ProgressComponent
     */
    public $Progress;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Progress = new ProgressComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Progress);

        parent::tearDown();
    }

    /**
     * Test determineApp method
     *
     * @return void
     */
    public function testDetermineApp()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test cacheApps method
     *
     * @return void
     */
    public function testCacheApps()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
