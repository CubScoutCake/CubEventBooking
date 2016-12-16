<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InvoicesPayments Controller
 *
 * @property \App\Model\Table\InvoicesPaymentsTable $InvoicesPayments
 */
class InvoicesPaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Invoices', 'Payments']
        ];
        $invoicesPayments = $this->paginate($this->InvoicesPayments);

        $this->set(compact('invoicesPayments'));
        $this->set('_serialize', ['invoicesPayments']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoices Payment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoicesPayment = $this->InvoicesPayments->get($id, [
            'contain' => ['Invoices', 'Payments']
        ]);

        $this->set('invoicesPayment', $invoicesPayment);
        $this->set('_serialize', ['invoicesPayment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoicesPayment = $this->InvoicesPayments->newEntity();
        if ($this->request->is('post')) {
            $invoicesPayment = $this->InvoicesPayments->patchEntity($invoicesPayment, $this->request->data);
            if ($this->InvoicesPayments->save($invoicesPayment)) {
                $this->Flash->success(__('The invoices payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoices payment could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->InvoicesPayments->Invoices->find('list', ['limit' => 200]);
        $payments = $this->InvoicesPayments->Payments->find('list', ['limit' => 200]);
        $this->set(compact('invoicesPayment', 'invoices', 'payments'));
        $this->set('_serialize', ['invoicesPayment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoices Payment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoicesPayment = $this->InvoicesPayments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoicesPayment = $this->InvoicesPayments->patchEntity($invoicesPayment, $this->request->data);
            if ($this->InvoicesPayments->save($invoicesPayment)) {
                $this->Flash->success(__('The invoices payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoices payment could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->InvoicesPayments->Invoices->find('list', ['limit' => 200]);
        $payments = $this->InvoicesPayments->Payments->find('list', ['limit' => 200]);
        $this->set(compact('invoicesPayment', 'invoices', 'payments'));
        $this->set('_serialize', ['invoicesPayment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoices Payment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoicesPayment = $this->InvoicesPayments->get($id);
        if ($this->InvoicesPayments->delete($invoicesPayment)) {
            $this->Flash->success(__('The invoices payment has been deleted.'));
        } else {
            $this->Flash->error(__('The invoices payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
