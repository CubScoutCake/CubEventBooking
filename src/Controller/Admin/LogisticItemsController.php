<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * LogisticItems Controller
 *
 * @property \App\Model\Table\LogisticItemsTable $LogisticItems
 */
class LogisticItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applications', 'Logistics', 'Params']
        ];
        $logisticItems = $this->paginate($this->LogisticItems);

        $this->set(compact('logisticItems'));
        $this->set('_serialize', ['logisticItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Logistic Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logisticItem = $this->LogisticItems->get($id, [
            'contain' => ['Applications', 'Logistics', 'Params']
        ]);

        $this->set('logisticItem', $logisticItem);
        $this->set('_serialize', ['logisticItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logisticItem = $this->LogisticItems->newEntity();
        if ($this->request->is('post')) {
            $logisticItem = $this->LogisticItems->patchEntity($logisticItem, $this->request->data);
            if ($this->LogisticItems->save($logisticItem)) {
                $this->Flash->success(__('The logistic item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The logistic item could not be saved. Please, try again.'));
            }
        }
        $applications = $this->LogisticItems->Applications->find('list', ['limit' => 200]);
        $logistics = $this->LogisticItems->Logistics->find('list', ['limit' => 200]);
        $params = $this->LogisticItems->Params->find('list', ['limit' => 200]);
        $this->set(compact('logisticItem', 'applications', 'logistics', 'params'));
        $this->set('_serialize', ['logisticItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Logistic Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logisticItem = $this->LogisticItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logisticItem = $this->LogisticItems->patchEntity($logisticItem, $this->request->data);
            if ($this->LogisticItems->save($logisticItem)) {
                $this->Flash->success(__('The logistic item has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The logistic item could not be saved. Please, try again.'));
            }
        }
        $applications = $this->LogisticItems->Applications->find('list', ['limit' => 200]);
        $logistics = $this->LogisticItems->Logistics->find('list', ['limit' => 200]);
        $params = $this->LogisticItems->Params->find('list', ['limit' => 200]);
        $this->set(compact('logisticItem', 'applications', 'logistics', 'params'));
        $this->set('_serialize', ['logisticItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Logistic Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logisticItem = $this->LogisticItems->get($id);
        if ($this->LogisticItems->delete($logisticItem)) {
            $this->Flash->success(__('The logistic item has been deleted.'));
        } else {
            $this->Flash->error(__('The logistic item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
