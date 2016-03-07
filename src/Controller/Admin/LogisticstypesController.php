<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Logisticstypes Controller
 *
 * @property \App\Model\Table\LogisticstypesTable $Logisticstypes
 */
class LogisticstypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('logisticstypes', $this->paginate($this->Logisticstypes));
        $this->set('_serialize', ['logisticstypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Logisticstype id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logisticstype = $this->Logisticstypes->get($id, [
            'contain' => ['Logistics']
        ]);
        $this->set('logisticstype', $logisticstype);
        $this->set('_serialize', ['logisticstype']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logisticstype = $this->Logisticstypes->newEntity();
        if ($this->request->is('post')) {
            $logisticstype = $this->Logisticstypes->patchEntity($logisticstype, $this->request->data);
            if ($this->Logisticstypes->save($logisticstype)) {
                $this->Flash->success(__('The logisticstype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The logisticstype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('logisticstype'));
        $this->set('_serialize', ['logisticstype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Logisticstype id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logisticstype = $this->Logisticstypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logisticstype = $this->Logisticstypes->patchEntity($logisticstype, $this->request->data);
            if ($this->Logisticstypes->save($logisticstype)) {
                $this->Flash->success(__('The logisticstype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The logisticstype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('logisticstype'));
        $this->set('_serialize', ['logisticstype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Logisticstype id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logisticstype = $this->Logisticstypes->get($id);
        if ($this->Logisticstypes->delete($logisticstype)) {
            $this->Flash->success(__('The logisticstype has been deleted.'));
        } else {
            $this->Flash->error(__('The logisticstype could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
