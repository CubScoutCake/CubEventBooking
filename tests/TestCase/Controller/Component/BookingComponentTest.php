<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\BookingComponent;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
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
        $roles = TableRegistry::get('Roles');

        // Six Year Old Beaver
        $sixYearOld = Date::now();
        $sixYearOld = $sixYearOld->subYears(6);
        $response = $this->Booking->guessRole($sixYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Beaver', $beaver->role);

        // Nine Year Old Cub
        $nineYearOld = Date::now();
        $nineYearOld = $nineYearOld->subYears(9);
        $response = $this->Booking->guessRole($nineYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Cub', $beaver->role);

        // Twelve Year Old Scout
        $twelveYearOld = Date::now();
        $twelveYearOld = $twelveYearOld->subYears(12);
        $response = $this->Booking->guessRole($twelveYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Scout', $beaver->role);

        // Fifteen Year Old Explorer
        $fifteenYearOld = Date::now();
        $fifteenYearOld = $fifteenYearOld->subYears(15);
        $response = $this->Booking->guessRole($fifteenYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Explorer', $beaver->role);

        // Twenty Year Old Leader
        $twentyYearOld = Date::now();
        $twentyYearOld = $twentyYearOld->subYears(20);
        $response = $this->Booking->guessRole($twentyYearOld->format('Y-m-d'));
        $beaver = $roles->get($response);
        $this->assertEquals('Leader', $beaver->role);

        $response = $this->Booking->guessRole('8sajgs');
        $this->assertFalse($response);
    }
}
