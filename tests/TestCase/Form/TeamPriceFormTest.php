<?php
namespace App\Test\TestCase\Form;

use App\Form\TeamPriceForm;
use Cake\TestSuite\TestCase;

/**
 * App\Form\TeamPriceForm Test Case
 */
class TeamPriceFormTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Form\TeamPriceForm
     */
    public $TeamPrice;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->TeamPrice = new TeamPriceForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TeamPrice);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $vars = [
            'convert' => true,
            'price' => 24,
        ];

        $this->assertTrue($this->TeamPrice->execute($vars));
    }
}
