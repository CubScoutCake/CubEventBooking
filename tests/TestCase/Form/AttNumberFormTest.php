<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\AttNumberForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\AttNumberForm Test Case
 */
class AttNumberFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\AttNumberForm
     */
    public $AttNumber;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->AttNumber = new AttNumberForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttNumber);

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
