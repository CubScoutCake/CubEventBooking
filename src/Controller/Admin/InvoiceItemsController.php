<?php
namespace App\Controller\Admin;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Invoices'],
            'conditions' => ['Invoices.user_id' => $this->Auth->user('id')]
        ];
        $this->set('invoiceItems', $this->paginate($this->InvoiceItems));
        $this->set('_serialize', ['invoiceItems']);
    }

    /**
     * View method
     *
     * @param string|null $invoiceItemId Invoice Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($invoiceItemId = null)
    {
        $invoiceItem = $this->InvoiceItems->get($invoiceItemId, [
            'contain' => ['Invoices' => ['conditions' => ['user_id' => $this->Auth->user('id')]]]
        ]);
        $this->set('invoiceItem', $invoiceItem);
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $invoiceItemId Invoice Item id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($invoiceItemId = null)
    {
        $invoiceItem = $this->InvoiceItems->get($invoiceItemId);

        $invNum = $invoiceItem->invoice_id;

        $permitted = [7, 8, 9, 10];
        if (!in_array($invoiceItem->item_type_id, $permitted)) {
            $this->Flash->error(__('You can only edit cancelled values.'));

            return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invNum]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->getData());
            if ($this->InvoiceItems->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));

                return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invNum]);
            } else {
                $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('invoiceItem'));
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * @param null $invID The ID of the Invoice
     * @param int $percentage The Fee Percentage
     *
     * @return \Cake\Http\Response|void
     */
    public function overdue($invID = null, $percentage = 10)
    {
        if (isset($invID)) {
            /** @var \App\Model\Entity\Invoice $invoice */
            $invoice = $this->InvoiceItems->Invoices->get($invID);

            $feePercent = $percentage / 100;

            $totalBalance = $invoice->initialvalue - $invoice->value;
            $fee = $totalBalance * $feePercent;

            $feeItem = $this->InvoiceItems->newEntity();

            $feeData = [
                'invoice_id' => $invID,
                'Quantity' => 1,
                'Value' => $fee,
                'Description' => 'Late Payment Surcharge - 10% of Balance',
                'itemtype_id' => 11,
                'visible' => 1
            ];

            $feeItem = $this->InvoiceItems->patchEntity($feeItem, $feeData);

            if ($this->InvoiceItems->save($feeItem)) {
                $this->Flash->success('An Overdue Surcharge was added to the invoice.');

                return $this->redirect(['controller' => 'Notifications', 'action' => 'surcharge', $invID, $percentage]);
            } else {
                $this->Flash->error('There was an error in adding a Surcharge.');

                return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
            }
        } else {
            $this->Flash->error('The Invoice ID was not set.');

            return $this->redirect(['controller' => 'Invoices', 'action' => 'outstanding']);
        }
    }
}
