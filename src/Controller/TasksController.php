<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TaskTypes', 'Users', 'CompletingUsers'],
            'finder' => [
                'ownedBy' => [
                    'userId' => $this->Auth->user('id')
                ]
            ],
        ];
        $tasks = $this->paginate($this->Tasks);

        $this->set(compact('tasks'));
    }

    /**
     * View method
     *
     * @param string|null $taskId Task id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($taskId = null)
    {
        $task = $this->Tasks->get($taskId, [
            'contain' => ['TaskTypes', 'Users']
        ]);

        $this->set('task', $task);
    }

    /**
     * @param array $user AuthUser Entity
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->getParam('action'), ['index'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->getParam('action'), ['view'])) {
            $taskId = $this->request->getParam('pass')[0];
            if ($this->Tasks->isOwnedBy($taskId, $user['id'])) {
                return true;
            }

            return false;
        }

        return parent::isAuthorized($user);
    }
}
