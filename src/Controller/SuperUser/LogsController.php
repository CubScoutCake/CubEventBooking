<?php
/**
 * CakePHP DatabaseLog Plugin
 *
 * Licensed under The MIT License.
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @link https://github.com/dereuromark/CakePHP-DatabaseLog
 */
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * @property \DatabaseLog\Model\Table\DatabaseLogsTable $DatabaseLogs
 */
class LogsController extends AppController
{

    /**
     * Explicitly use the Log model.
     *
     * Fixes problems with the controller test.
     *
     * @var string
     */
    public $modelClass = 'DatabaseLog.DatabaseLogs';

    /**
     * Load the TimeHelper
     *
     * @var array
     */
    public $helpers = ['Time', 'DatabaseLog.Log'];

    /**
     * Setup pagination
     *
     * @var array
     */
    public $paginate = [
        'order' => ['DatabaseLogs.id' => 'DESC'],
        'fields' => [
            'DatabaseLogs.created',
            'DatabaseLogs.type',
            'DatabaseLogs.message',
            'DatabaseLogs.id'
        ]
    ];

    /**
     * Index/Overview action
     *
     * @return void
     */
    public function index()
    {
        $types = $this->DatabaseLogs->getTypes();
        $this->set(compact('types'));

        $conditions = $this->DatabaseLogs->textSearch();
        $type = $this->request->query('type');
        if ($type) {
            $conditions['type'] = $type;
        }
        $query = $this->DatabaseLogs->find()->where($conditions);
        $this->paginate = [
            'order' => ['created' => 'DESC'],
        ];

        $this->set('logs', $this->paginate($query));
        $this->set('types', $this->DatabaseLogs->getTypes());
    }

    /**
     * @param null|int $id The log ID to view.
     * @return void
     */
    public function view($id = null)
    {
        $log = $this->DatabaseLogs->get($id);
        $this->set('log', $log);
    }

    /**
     * Delete action
     *
     * @param null|int $id The log ID to delete.
     * @return \Cake\Network\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod('post');
        $log = $this->DatabaseLogs->get($id);

        if ($this->DatabaseLogs->delete($log)) {
            $this->Flash->success(__('Log deleted'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Log was not deleted'));

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Reset action
     *
     * Deletes all log entries.
     *
     * @return \Cake\Network\Response|null
     */
    public function reset()
    {
        $this->request->allowMethod('post');

        $this->DatabaseLogs->truncate();

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Remove duplicates action
     *
     * @return \Cake\Network\Response|null
     */
    public function removeDuplicates()
    {
        $this->request->allowMethod('post');

        $this->DatabaseLogs->removeDuplicates();

        $this->Flash->success(__('Duplicate Logs have been removed.'));

        $this->log('Duplicate Logs Removed', 'info');

        return $this->redirect($this->referer(['action' => 'index', 'controller' => 'Logs']));
    }
}
