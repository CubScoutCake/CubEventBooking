<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * InvoiceItems Controller
 *
 * @property \App\Model\Table\InvoiceItemsTable $InvoiceItems
 *
 * @property \App\Controller\Component\LineComponent $Line
 */
class InvoiceItemsController extends AppController
{
    /**
     * @param null $invID The Invoice ID
     *
     * @return \Cake\Http\Response|null
     *
     * @throws \Exception
     */
    public function populate($invID = null)
    {
        $this->loadComponent('Line');
        $parse = $this->Line->parseInvoice($invID);

        if ($parse) {
            $this->Flash->success('Invoice Successfully Populated.');

            return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
        }

        $invoices = TableRegistry::getTableLocator()->get('Invoices');
        $invoice = $invoices->get($invID);

        $this->Flash->error('There was an Error Populating your Invoice.');

        return $this->redirect(['controller' => 'Application', 'action' => 'view', $invoice->application_id]);
    }

    /**
     * @param null $invId The Invoice ID.
     *
     * @return \Cake\Http\Response|null
     */
    public function repopulate($invId = null)
    {
        return $this->redirect(['action' => 'populate', $invId]);
    }
}
