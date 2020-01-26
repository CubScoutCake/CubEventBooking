<?php
declare(strict_types=1);

namespace App\Test\TestCase\Form;

use App\Form\PaymentAssocationForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\PaymentAssocationForm Test Case
 */
class PaymentAssocationFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Form\PaymentAssocationForm
     */
    public $PaymentAssocation;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->PaymentAssocation = new PaymentAssocationForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PaymentAssocation);

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
