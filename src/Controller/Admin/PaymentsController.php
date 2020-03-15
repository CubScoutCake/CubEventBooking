<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\PaymentAssocationForm;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 * @property \App\Model\Table\EmailSendsTable $EmailSends
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
            'order' => ['Payments.created' => 'DESC'],
        ];
        $this->set('payments', $this->paginate($this->Payments));
        $this->set('_serialize', ['payments']);
    }

    /**
     * View method
     *
     * @param int $paymentId Payment id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($paymentId = null)
    {
        $payment = $this->Payments->get($paymentId, [
            'contain' => ['Invoices', 'Users', 'Invoices.Users'],
        ]);
        $this->set('payment', $payment);
        $this->set('_serialize', ['payment']);
    }

    /**
     * Add method
     *
     * @param int $numberOfInvAssocs a number for the amount of invoice lines available.
     * @param int $invId a suggested invoice to association
     *
     * @return \Cake\Http\Response Redirects on successful add, renders view otherwise.
     */
    public function add($numberOfInvAssocs = null, $invId = null)
    {
        if (is_null($numberOfInvAssocs) || $numberOfInvAssocs < 1) {
            $paymentAssocForm = new PaymentAssocationForm();
            $this->set(compact('paymentAssocForm', 'invId', 'numberOfInvAssocs'));

            if ($this->request->is('post')) {
                $requested = $this->request->getData('payment_assoc_count');

                $this->redirect(['action' => 'add', $requested, $invId]);
            }
        }

        if (! is_null($numberOfInvAssocs) && $numberOfInvAssocs > 0) {
            $payment = $this->Payments->newEntity();
            if ($this->request->is('post')) {
                $newData = ['user_id' => $this->Auth->user('id')];
                $payment = $this->Payments->patchEntity($payment, $newData);

                $payment = $this->Payments->patchEntity($payment, $this->request->getData(), [
                    'associated' => [
                        'Invoices',
                    ],
                ]);

                if ($this->Payments->save($payment)) {
                    $this->Flash->success(__('The payment has been saved.'));

                    $payment = $this->Payments->get($payment->get('id'), ['contain' => 'Invoices']);
                    $this->loadModel('EmailSends');
                    $this->EmailSends->make('PAY-' . $payment->get('id') . '-REC');

                    return $this->redirect(['action' => 'add']);
                } else {
                    $this->Flash->error(__('The payment could not be saved. Please, try again.'));
                }
            }

            $invoices = $this->Payments->Invoices->find('unarchived')->find('outstanding')->find('active')->find(
                'list',
                [
                    'limit' => 500,
                    'order' => ['Invoices.id' => 'DESC'],
                ]
            );

            $invDefault = $invId;

            if (! isset($invId)) {
                $invDefault = 'empty';
            }

            $this->set(compact('payment', 'invoices', 'numberOfInvAssocs', 'invId', 'invDefault'));
            $this->set('_serialize', ['payment']);
        }
    }

    /**
     * Edit method
     *
     * @param int $paymentId Payment id.
     * @param int $numInvAssociated a number for the amount of invoice lines available.
     *
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($paymentId = null, $numInvAssociated = null)
    {
        $payment = $this->Payments->get($paymentId, [
            'contain' => ['Invoices'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());

            $payment = $this->Payments->patchEntity($payment, $this->request->getData(), [
                'associated' => [
                    'Invoices',
                ],
            ]);

            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'view', $payment->id]);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->Payments->Invoices->find('unarchived')->find(
            'list',
            ['limit' => 200, 'order' => ['Invoices.id' => 'DESC']]
        );

        if (is_null($numInvAssociated)) {
            $numInvAssociated = 1;
        }

        $this->set(compact('payment', 'invoices', 'numInvAssociated'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $paymentId Payment id.
     *
     * @return \Cake\Http\Response Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
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
