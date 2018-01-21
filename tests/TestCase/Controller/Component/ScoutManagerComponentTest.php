<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ScoutManagerComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
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

        $this->passthrough = Configure::read('travis');
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
    	if ($this->passthrough) {
    		$this->markTestSkipped('Skipped for Travis until Mocked.');
	    }


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
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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
            'attendee_count' => 12,
            'next_step' => 'term',
        ];

        $this->assertEquals($expectedArray, $component);
    }

    /**
     * Test Link User Function
     */
    public function testLinkUser()
    {
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

        $secret = 'MyGoatIsNewPasswordSecret';
        $component = $this->ScoutManager->storeUserSecret($secret, 1);

        $this->assertTrue($component);

        $users = TableRegistry::get('Users');
        $user = $users->get(1);

        $this->assertEquals($secret, $user->osm_secret);
    }

    public function testStoreAndRetrieveUserSecret()
    {
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

        $secret = 'MyGoatIsNewPasswordSecret';
        $component = $this->ScoutManager->storeUserSecret($secret, 1);

        $this->assertTrue($component);

        $retrieval = $this->ScoutManager->retrieveUserSecret(1);

        $this->assertNotFalse($retrieval);

        $this->assertEquals($secret, $retrieval);
    }

    public function testGetSectionIds()
    {
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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

    public function testGetEventAttendees()
    {
	    if ($this->passthrough) {
		    $this->markTestSkipped('Skipped for Travis until Mocked.');
	    }

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

        $osmEvent = 322013;

        $response = $this->ScoutManager->getEventAttendees(1, $osmEvent);

        $expectedResponse = [
            [
                'scoutid' => '343558',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Jude',
                'lastname' => 'Davies',
                'dob' => '2007-12-12',
                'patrolid' => '47677'
            ],
            [
                'scoutid' => '343556',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Oscar',
                'lastname' => 'Davies',
                'dob' => '2007-12-12',
                'patrolid' => '47677'
            ],
            [
                 'scoutid' => '607747',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Owen ',
                'lastname' => 'Humpherys ',
                'dob' => '2008-02-23',
                'patrolid' => '59853'
            ],
            [
                'scoutid' => '274599',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Oliver',
                'lastname' => 'Kersley-Allinson',
                'dob' => '2008-07-06',
                'patrolid' => '59853'
            ],
            [
                'scoutid' => '525654',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Kirian ',
                'lastname' => 'Thode',
                'dob' => '2008-09-21',
                'patrolid' => '18238'
            ],
            [
                'scoutid' => '842477',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Emily',
                'lastname' => 'Thompson',
                'dob' => '2007-11-06',
                'patrolid' => '18237'
            ],
            [
                'scoutid' => '680628',
                'attending' => 'Yes',
                'payment' => 'Automatic',
                'firstname' => 'Oscar',
                'lastname' => 'Vincent',
                'dob' => '2008-01-01',
                'patrolid' => '18237'
            ],
        ];

        $this->assertEquals($expectedResponse, $response);
    }
}
