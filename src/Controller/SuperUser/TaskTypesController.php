<?php
declare(strict_types=1);

namespace App\Controller\SuperUser;

use App\Controller\AppController;

/**
 * TaskTypes Controller
 *
 * @property \App\Model\Table\TaskTypesTable $TaskTypes
 *
 * @method \App\Model\Entity\TaskType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TaskTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $taskTypes = $this->paginate($this->TaskTypes);

        $this->set(compact('taskTypes'));
    }

    /**
     * View method
     *
     * @param string|null $taskId Task Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($taskId = null)
    {
        $taskType = $this->TaskTypes->get($taskId, [
            'contain' => ['Tasks'],
        ]);

        $this->set('taskType', $taskType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taskType = $this->TaskTypes->newEntity();
        if ($this->request->is('post')) {
            $taskType = $this->TaskTypes->patchEntity($taskType, $this->request->getData());
            if ($this->TaskTypes->save($taskType)) {
                $this->Flash->success(__('The task type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task type could not be saved. Please, try again.'));
        }
        $this->set(compact('taskType'));
    }

    /**
     * Edit method
     *
     * @param string|null $taskId Task Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($taskId = null)
    {
        $taskType = $this->TaskTypes->get($taskId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taskType = $this->TaskTypes->patchEntity($taskType, $this->request->getData());
            if ($this->TaskTypes->save($taskType)) {
                $this->Flash->success(__('The task type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task type could not be saved. Please, try again.'));
        }
        $this->set(compact('taskType'));
    }

    /**
     * Delete method
     *
     * @param string|null $taskId Task Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($taskId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taskType = $this->TaskTypes->get($taskId);
        if ($this->TaskTypes->delete($taskType)) {
            $this->Flash->success(__('The task type has been deleted.'));
        } else {
            $this->Flash->error(__('The task type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
