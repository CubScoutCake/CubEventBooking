<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'order' => ['Payments.created' => 'DESC']
        ];
        $this->set('payments', $this->paginate($this->Payments));
        $this->set('_serialize', ['payments']);
    }

    /**
     * View method
     *
     * @param int $paymentId Payment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($paymentId = null)
    {
        $payment = $this->Payments->get($paymentId, [
            'contain' => ['Invoices', 'Users', 'Invoices.Users']
        ]);
        $this->set('payment', $payment);
        $this->set('_serialize', ['payment']);
    }

    /**
     * Add method
     *
     * @param int $invId a suggested invoice to associate
     * @param int $numberOfInvoiceAssocs a number for the amount of invoice lines available.
     * @return \Cake\Http\Response Redirects on successful add, renders view otherwise.
     */
    public function add($invId = null, $numberOfInvoiceAssocs = null)
    {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $newData = ['user_id' => $this->Auth->user('id')];
            $payment = $this->Payments->patchEntity($payment, $newData);

            $payment = $this->Payments->patchEntity($payment, $this->request->data, [
                'associated' => [
                    'Invoices'
                ]
            ]);

            if ($this->Payments->save($payment)) {
                $redir = $payment->get('id');

                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['controller' => 'Notifications', 'action' => 'new_payment', 'prefix' => 'admin', $redir]);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }

        $invoices = $this->Payments->Invoices->find('unarchived')->find('list', ['limit' => 200, 'order' => ['Invoices.id' => 'DESC']]);

        if (isset($invId)) {
            $invoices = $this->Payments->Invoices->find('list', ['conditions' => ['Invoices.id' => $invId]]);
        }

        if (is_null($numberOfInvoiceAssocs)) {
            $numberOfInvoiceAssocs = 1;
        }

        $this->set(compact('payment', 'invoices', 'numberOfInvoiceAssocs'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Edit method
     *
     * @param int $paymentId Payment id.
     * @param int $numberOfInvoiceAssocs a number for the amount of invoice lines available.
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($paymentId = null, $numberOfInvoiceAssocs = null)
    {
        $payment = $this->Payments->get($paymentId, [
            'contain' => ['Invoices']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->data);

            $payment = $this->Payments->patchEntity($payment, $this->request->data, [
                'associated' => [
                    'Invoices'
                ]
            ]);

            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'view', $payment->id]);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->Payments->Invoices->find('unarchived')->find('list', ['limit' => 200, 'order' => ['Invoices.id' => 'DESC']]);

        if (is_null($numberOfInvoiceAssocs)) {
            $numberOfInvoiceAssocs = 1;
        }

        $this->set(compact('payment', 'invoices', 'numberOfInvoiceAssocs'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $paymentId Payment id.
     * @return \Cake\Http\Response Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($paymentId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($paymentId);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
