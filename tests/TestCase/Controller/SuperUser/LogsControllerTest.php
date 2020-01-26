<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\SuperUser;

use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SuperUser\LogsController Test Case
 *
 * @property \DatabaseLog\Model\Table\DatabaseLogsTable $Logs
 */
class LogsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
//        'plugin.DatabaseLog.DatabaseLogs',
    ];

    /**
     * @return int
     */
    private function doLog()
    {
        if (Configure::read('travis')) {
            $this->markTestSkipped('Unable to replicate fixtures on Travis.');
        }

        $this->Logs = TableRegistry::getTableLocator()->get('DatabaseLog.DatabaseLogs');
        if (!$this->Logs->find()->count()) {
            $this->Logs->log('warning', 'Foo Warning', ['x' => 'y']);
        }

        $message = 'This is a log test';
        Log::warning($message);

        $log = $this->Logs->find()->where(['message' => $message])->first();

        return $log->id;
    }

    /**
     * Test index method
     *
     * @return void
     *
     * @throws
     */
    public function testIndex()
    {
        if (Configure::read('travis')) {
            $this->markTestSkipped('Unable to replicate fixtures on Travis.');
        }

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->get([
            'prefix' => 'super_user',
            'controller' => 'logs',
            'action' => 'index',
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     *
     * @throws
     */
    public function testView()
    {
        if (Configure::read('travis')) {
            $this->markTestSkipped('Unable to replicate fixtures on Travis.');
        }

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $msgId = $this->doLog();

        $this->get([
            'prefix' => 'super_user',
            'controller' => 'logs',
            'action' => 'view',
            $msgId,
        ]);

        $this->assertResponseOk();
    }

    /**
     * Test delete method
     *
     * @return void
     *
     * @throws
     */
    public function testDelete()
    {
        if (Configure::read('travis')) {
            $this->markTestSkipped('Unable to replicate fixtures on Travis.');
        }

        $this->session([
            'Auth.User.id' => 1,
            'Auth.User.auth_role_id' => 2,
        ]);

        $this->enableRetainFlashMessages();
        $this->enableSecurityToken();
        $this->enableCsrfToken();

        $msgId = $this->doLog();

        $this->post([
            'prefix' => 'super_user',
            'controller' => 'logs',
            'action' => 'delete',
            $msgId,
        ], []);

        $this->assertRedirect();

        $this->assertFlashMessage('Log deleted');
    }

    /**
     * Test reset method
     *
     * @return void
     */
    public function testReset()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test removeDuplicates method
     *
     * @return void
     */
    public function testRemoveDuplicates()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
