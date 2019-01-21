<?php
namespace App\TestCase\Controller\SuperUser;

use App\Controller\SuperUser\LogsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * @coversDefaultClass LogsController
 */
class LogsControllerTest extends IntegrationTestCase
{

    /**
     * @var \DatabaseLog\Model\Table\DatabaseLogsTable
     */
    protected $Logs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.logs',
        'app.sessions',
        'app.allergies',
        'app.application_statuses',
        'app.applications',
        'app.applications_attendees',
        'app.attendees',
        'app.attendees_allergies',
        'app.auth_roles',
        'app.champions',
        'app.discounts',
        'app.districts',
        'app.email_response_types',
        'app.email_responses',
        'app.email_sends',
        'app.event_statuses',
        'app.event_types',
        'app.events',
        'app.invoice_items',
        'app.invoices',
        'app.invoices_payments',
        'app.item_types',
        'app.logistic_items',
        'app.logistics',
        'app.notes',
        'app.notification_types',
        'app.notifications',
        'app.parameter_sets',
        'app.parameters',
        'app.params',
        'app.password_states',
        'app.payments',
        'app.prices',
        'app.reservation_statuses',
        'app.reservations',
        'app.roles',
        'app.scoutgroups',
        'app.section_types',
        'app.sections',
        'app.setting_types',
        'app.settings',
        'app.users',
    ];

    /**
     * Setup
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->Logs = TableRegistry::get('DatabaseLog.DatabaseLogs');
        if (!$this->Logs->find()->count()) {
            $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);
        }
    }

    /**
     * Tests the index action
     *
     * @return void
     */
    public function testIndex()
    {
        $this->session([
           'Auth.User.id' => 1,
           'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'Logs']);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    /**
     * Tests the view action
     *
     * @return void
     */
    public function testView()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'Logs', 'action' => 'view', '1']);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    /**
     * Tests the delete action without POST
     *
     * @return void
     */
    public function testDeleteWithoutPost()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'Logs', 'action' => 'delete', '1']);

        $this->assertNoRedirect();
        $this->assertResponseCode(405);
    }

    /**
     * Tests the delete action
     *
     * @return void
     */
    public function testDelete()
    {
        //$this->markTestSkipped();

        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);
        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);

        $countInitial = $this->Logs->find()->count();

        $first = $this->Logs->find()->first()->id;

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(
            ['prefix' => 'super_user', 'controller' => 'Logs', 'action' => 'delete', $first]
        );
        $count = $this->Logs->find()->count();

        $this->assertSame(($countInitial - 1), $count);
    }

    /**
     * Tests the reset action without POST
     *
     * @return void
     */
    public function testResetWithoutPost()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->get(['prefix' => 'super_user', 'controller' => 'Logs', 'action' => 'reset']);

        $this->assertNoRedirect();
        $this->assertResponseCode(405);
    }

    /**
     * Tests the remove duplicates action
     *
     * @return void
     */
    public function testRemoveDuplicates()
    {
        $this->markTestSkipped('This one is a bugger');

        $countInitial = $this->Logs->find()->count();

        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);
        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);
        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(['prefix' => 'super_user', 'controller' => 'Logs', 'action' => 'removeDuplicates']);

        $count = $this->Logs->find()->count();

        $logged = $this->Logs->find()->where(['type' => 'info', 'message' => 'Duplicate Logs Removed'])->count();

        $this->assertGreaterThanOrEqual(1, $logged);

        $count = $count - $logged;

        $this->assertLessThan($countInitial, $count);
    }

    /**
     * Tests the reset action
     *
     * @return void
     */
    public function testReset()
    {
        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2
        ]);

        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);
        $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);

        $count = $this->Logs->find()->count();
        $this->assertGreaterThanOrEqual(1, $count);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(['prefix' => 'super_user', 'controller' => 'Logs', 'action' => 'reset']);

        $this->assertResponseSuccess();
        $this->assertRedirect();

        $count = $this->Logs->find()->count();

        $this->assertEquals(0, $count);
    }
}
