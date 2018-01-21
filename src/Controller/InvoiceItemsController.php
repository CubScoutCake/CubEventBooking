<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\InvForm;
use Cake\ORM\TableRegistry;

/**
 * InvoiceItems Controller
 *
 * @property \App\Model\Table\InvoiceItemsTable $InvoiceItems
 */
class InvoiceItemsController extends AppController
{
	/**
	 * @param null $invID
	 *
	 * @return \Cake\Http\Response|null
	 */
    public function populate($invID = null)
    {
        $this->loadComponent('Line');
        $parse = $this->Line->parseInvoice($invID);

        if ($parse) {
        	$this->Flash->success('Invoice Successfully Populated.');
        	return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
        }

        $invoices = TableRegistry::get('Invoices');
        $invoice = $invoices->get($invID);

	    $this->Flash->error('There was an Error Populating your Invoice.');
	    return $this->redirect(['controller' => 'Application', 'action' => 'view', $invoice->application_id]);
    }

    public function repopulate($invID = null)
    {
	    return $this->redirect(['action' => 'populate', $invID]);
    }
}
