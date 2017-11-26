<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ScoutManagerComponent;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ScoutManagerComponent Test Case
 */
class ScoutManagerComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ScoutManagerComponent
     */
    public $ScoutManager;

    public $fixtures = [
        'app.allergies',
        'app.attendees',
        'app.roles',
        'app.districts',
        'app.scoutgroups',
        'app.users',
        'app.password_states',
        'app.attendees_allergies',
        'app.sections',
        'app.section_types',
        'app.auth_roles',
        'app.notifications',
        'app.notificationtypes',
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
        $this->ScoutManager = new ScoutManagerComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ScoutManager);

        parent::tearDown();
    }

    public function testGetSettings()
    {
        $component = $this->ScoutManager->getOsmSettings();

        $this->assertTrue(is_array($component));

        $this->assertArrayHasKey('api_id', $component);
        $this->assertArrayHasKey('api_base', $component);
        $this->assertArrayHasKey('api_token', $component);
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testCheckOsmStatus()
    {
        $component = $this->ScoutManager->checkOsmStatus(1);

        $this->assertTrue(is_array($component));

        $this->assertArrayHasKey('linked', $component);
        $this->assertArrayHasKey('sectionSet', $component);
        $this->assertArrayHasKey('termCurrent', $component);
        $this->assertArrayHasKey('attendees_present', $component);
        $this->assertArrayHasKey('attendee_count', $component);
        $this->assertArrayHasKey('next_step', $component);

        $this->assertTrue(is_bool($component['linked']));
        $this->assertTrue(is_bool($component['sectionSet']));
        $this->assertTrue(is_bool($component['termCurrent']));
        $this->assertTrue(is_bool($component['attendees_present']));
        $this->assertTrue(is_int($component['attendee_count']));
        $this->assertTrue(is_string($component['next_step']));

        $expectedArray = [
            'linked' => true,
            'sectionSet' => true,
            'termCurrent' => false,
            'attendees_present' => true,
            'attendee_count' => 1,
            'next_step' => 'term',
        ];

        $this->assertEquals($expectedArray, $component);
    }

    /**
     * Test Link User Function
     */
    public function testLinkUser()
    {
        $authArray = [
            'osm_email' => 'jacob@4thletchworth.com',
            'osm_password' => 'Rho9Sigma',
            'user_id' => 1
        ];

        $component = $this->ScoutManager->linkUser($authArray);

        $this->assertTrue($component);
    }

    /**
     * Test Wrong Password Response to Link User Function.
     */
    public function testLinkUserWrongPassword()
    {
        $authArray = [
            'osm_email' => 'jacob@4thletchworth.com',
            'osm_password' => 'afsjflkaljksg',
            'user_id' => 1
        ];

        $component = $this->ScoutManager->linkUser($authArray);

        $this->assertFalse($component);
    }

    public function testStoreUserSecret()
    {
        $secret = 'MyGoatIsNewPasswordSecret';
        $component = $this->ScoutManager->storeUserSecret($secret, 1);

        $this->assertTrue($component);

        $users = TableRegistry::get('Users');
        $user = $users->get(1);

        $this->assertEquals($secret, $user->osm_secret);
    }

    public function testStoreAndRetrieveUserSecret()
    {
        $secret = 'MyGoatIsNewPasswordSecret';
        $component = $this->ScoutManager->storeUserSecret($secret, 1);

        $this->assertTrue($component);

        $retrieval = $this->ScoutManager->retrieveUserSecret(1);

        $this->assertNotFalse($retrieval);

        $this->assertEquals($secret, $retrieval);
    }

    public function testGetSectionIds()
    {
        $authArray = [
            'osm_email' => 'jacob@4thletchworth.com',
            'osm_password' => 'Rho9Sigma',
            'user_id' => 1
        ];

        $component = $this->ScoutManager->linkUser($authArray);

        $this->assertTrue($component);

        $sectionComponent = $this->ScoutManager->getSectionIds(1);

        $this->assertTrue(is_array($sectionComponent));
    }

    public function testSetTerm()
    {
        $authArray = [
            'osm_email' => 'jacob@4thletchworth.com',
            'osm_password' => 'Rho9Sigma',
            'user_id' => 1
        ];

        $component = $this->ScoutManager->linkUser($authArray);

        $this->assertTrue($component);

        $users = TableRegistry::get('Users');
        $user = $users->get(1);

        $user->osm_section_id = 11122;

        $users->save($user);

        $termComponent = $this->ScoutManager->setTerm(1);

        $this->assertTrue($termComponent);

        $now = Time::now();

        $user = $users->get(1);
        $this->assertNotEmpty($user->osm_current_term);
        $this->assertGreaterThan($now, $user->osm_term_end);
    }

    public function testGetEvents()
    {
        $authArray = [
            'osm_email' => 'jacob@4thletchworth.com',
            'osm_password' => 'Rho9Sigma',
            'user_id' => 1
        ];

        $component = $this->ScoutManager->linkUser($authArray);

        $this->assertTrue($component);

        $users = TableRegistry::get('Users');
        $user = $users->get(1);

        $user->osm_section_id = 11122;

        $users->save($user);

        $termComponent = $this->ScoutManager->setTerm(1);

        $this->assertTrue($termComponent);

        $eventList = $this->ScoutManager->getEventList(1);

        $this->assertNotEmpty($eventList);
    }
}
