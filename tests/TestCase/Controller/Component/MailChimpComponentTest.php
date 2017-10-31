<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\MailChimpComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\MailChimpComponent Test Case
 */
class MailChimpComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\MailChimpComponent
     */
    public $MailChimp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->MailChimp = new MailChimpComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MailChimp);

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
