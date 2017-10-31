<?php
namespace App\Test\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\EventTypesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EventTypesController Test Case
 */
class EventTypesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     *
	public $fixtures = [
		'app.event_types',
		'app.events',
		'app.settings',
		'app.setting_types',
		'app.discounts',
		'app.users',
		'app.password_states',
		'app.roles',
		'app.attendees',
		'app.sections',
		'app.section_types',
		'app.scoutgroups',
		'app.districts',
		'app.champions',
		'app.applications',
		'app.invoices',
		'app.invoice_items',
		'app.item_types',
		'app.prices',
		'app.notes',
		'app.prices',
		'app.payments',
		'app.invoices_payments',
		'app.logistic_items',
		'app.logistics',
		'app.parameters',
		'app.parameter_sets',
		'app.params',
		'app.applications_attendees',
		'app.allergies',
		'app.attendees_allergies',
		'app.auth_roles',
		'app.notifications',
		'app.notification_types'
	];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
    	$this->markTestSkipped('This has been skipped.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'index']);

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
	    $this->markTestSkipped('This has been skipped.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'view', 1]);

        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
	    $this->markTestSkipped('This has been skipped.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'add']);

        $this->assertResponseOk();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
	    $this->markTestSkipped('This has been skipped.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'edit', 1]);

        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
	    $this->markTestSkipped('This has been skipped.');

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'delete', 2]);

        $this->assertRedirect(['controller' => 'EventTypes', 'action' => 'index']);
    }

    /**
     * Test index Unauthorised method
     *
     * @return void
     */
    public function testIndexUnauthorised()
    {
	    //$this->markTestSkipped('This has been skipped.');

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'index']);

        $this->assertRedirect('/login?redirect=%2Fsuper_user%2Fevent-types');
    }

    /**
     * Test view Unauthorised method
     *
     * @return void
     */
    public function testViewUnauthorised()
    {
	    //$this->markTestSkipped('This has been skipped.');

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'view', 1]);

        $this->assertRedirect('/login?redirect=%2Fsuper_user%2Fevent-types%2Fview%2F1');
    }

    /**
     * Test add Unauthorised method
     *
     * @return void
     */
    public function testAddUnauthorised()
    {
	    //$this->markTestSkipped('This has been skipped.');

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'add']);

        $this->assertRedirect('/login?redirect=%2Fsuper_user%2Fevent-types%2Fadd');
    }

    /**
     * Test edit Unauthorised method
     *
     * @return void
     */
    public function testEditUnauthorised()
    {
	    //$this->markTestSkipped('This has been skipped.');

        $this->get(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'edit', 1]);

        $this->assertRedirect('/login?redirect=%2Fsuper_user%2Fevent-types%2Fedit%2F1');
    }

    /**
     * Test delete Unauthorised method
     *
     * @return void
     */
    public function testDeleteUnauthorised()
    {
	    //$this->markTestSkipped('This has been skipped.');

        $this->post(['prefix' => 'super_user', 'controller' => 'EventTypes', 'action' => 'delete', 1]);

        $this->assertRedirect('/login');
    }
}
