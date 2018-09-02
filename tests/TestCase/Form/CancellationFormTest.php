<?php
namespace App\Test\TestCase\Form;

use App\Form\CancellationForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\CancellationForm Test Case
 */
class CancellationFormTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Form\CancellationForm
     */
    public $Cancellation;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Cancellation = new CancellationForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cancellation);

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
