<?php
namespace App\Controller\Champion;

use App\Controller\Champion\AppController;
use Cake\ORM\TableRegistry;

/**
 * InvoiceItems Controller
 *
 * @property \App\Model\Table\InvoiceItemsTable $InvoiceItems
 */
class InvoiceItemsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Invoices']
        ];
        $this->set('invoiceItems', $this->paginate($this->InvoiceItems));
        $this->set('_serialize', ['invoiceItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Item id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceItem = $this->InvoiceItems->get($id, [
            'contain' => ['Invoices']
        ]);
        $this->set('invoiceItem', $invoiceItem);
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');
        
        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));
        
        $invoiceItem = $this->InvoiceItems->newEntity();
        if ($this->request->is('post')) {
            $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->data);
            if ($this->InvoiceItems->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->InvoiceItems->Invoices->find('list', ['limit' => 200, 'contain' => ['Applications.Users.Scoutgroups'], 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        $this->set(compact('invoiceItem', 'invoices'));
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Item id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceItem = $this->InvoiceItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->data);
            if ($this->InvoiceItems->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->InvoiceItems->Invoices->find('list', ['limit' => 200]);
        $this->set(compact('invoiceItem', 'invoices'));
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Item id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceItem = $this->InvoiceItems->get($id);
        if ($this->InvoiceItems->delete($invoiceItem)) {
            $this->Flash->success(__('The invoice item has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
