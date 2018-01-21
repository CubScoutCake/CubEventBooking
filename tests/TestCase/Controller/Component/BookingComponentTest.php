<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\BookingComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\BookingComponent Test Case
 */
class BookingComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\BookingComponent
     */
    public $Booking;

    public $fixtures = [
        'app.roles',
        'app.section_types',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Booking = new BookingComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Booking);

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

    /**
     * Test GuessSectionType Function
     *
     * @return void
     */
    public function testGuessSectionType()
    {
        $response = $this->Booking->guessRole('2010-03-09');
        $this->assertEquals(2, $response);

        $response = $this->Booking->guessRole('2008-03-09');
        $this->assertEquals(3, $response);

        $response = $this->Booking->guessRole('2005-03-09');
        $this->assertEquals(4, $response);

        $response = $this->Booking->guessRole('2003-03-09');
        $this->assertEquals(5, $response);

        $response = $this->Booking->guessRole('1990-03-09');
        $this->assertEquals(1, $response);

        $response = $this->Booking->guessRole('8sajgs');
        $this->assertFalse($response);
    }
}
