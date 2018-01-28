<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $payments = $this->Payments;
//        $myPayments = $this->paginate($payments->find()->matching('Invoices', function ($q) {
//                return $q->where(['Invoices.user_id' => $this->Auth->user('id')]);
//        })->distinct()->contain(['Invoices']));


        $myPayments = $this->paginate($payments->find()->contain(['Invoices']));

        /*$matchingComment = $this->Payments->association('Invoices')->find()
                                    ->select(['article_id'])
                                    ->distinct()
                                    ->where(['Invoices.user_id' => $this->Auth->user('id')]);

        $query = $this->Payments->find()
                          ->where(['id IN' => $matchingComment]);*/

        $this->set('payments', $myPayments);
        $this->set('_serialize', ['payments']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Invoices']
        ]);
        $this->set('payment', $payment);
        $this->set('_serialize', ['payment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    /*public function add()
    {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->data);
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->Payments->Invoices->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'invoices'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Invoices']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->data);
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->Payments->Invoices->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'invoices'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }*/
}
