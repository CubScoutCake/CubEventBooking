<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'] /*, 'conditions' => ['application_id is NULL']*/
        ];
        $this->set('invoices', $this->paginate($this->Invoices));
        $this->set('_serialize', ['invoices']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $settings = TableRegistry::get('Settings');
        
        //$query = $settings->find();

        $legal = $settings
            ->find()
            ->where(['id' => 4])
            ->first();

        $legaltext = $legal->text;



        $invoice = $this->Invoices->get($id, [
            'contain' => ['Users', 'Payments', 'InvoiceItems']
        ]);
        $this->set('invoice', $invoice);
        $this->set('setting', $legaltext);
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $users = $this->Invoices->Users->find('list', ['limit' => 200]);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200]);
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200]);
        $this->set(compact('invoice', 'users', 'payments', 'applications'));
        $this->set('_serialize', ['invoice']);

        if ($this->request->is('get')) {
            
            // Values from the Model e.g.
            $this->request->data['user_id'] = $userId;
        }
              
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Payments']
        ]);
        $userThis = $invoice->user_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $users = $this->Invoices->Users->find('list', ['limit' => 200]);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200]);
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userThis]]);
        $this->set(compact('invoice', 'users', 'payments', 'applications'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
