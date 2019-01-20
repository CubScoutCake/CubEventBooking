<?php
namespace App\Test\TestCase\Form;

use App\Form\EntryForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\EntryForm Test Case
 */
class EntryFormTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Form\EntryForm
     */
    public $Entry;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Entry = new EntryForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Entry);

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
