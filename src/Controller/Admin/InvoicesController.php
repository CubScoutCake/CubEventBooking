<?php
namespace App\Controller\Admin;

use Mpdf\Tag\P;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 *
 * @property \App\Controller\Component\LineComponent $Line
 */
class InvoicesController extends AppController
{

    /**
     * Index method
     *
     * @param int|null $eventId The ID of the Event to View Invoices Against
     *
     * @return void
     */
    public function index($eventId = null)
    {
        $query = $this->request->getQueryParams();
        $data = $this->Invoices->find('all');
        $term = 'All';

        if (key_exists('unpaid', $query)) {
            $data = $this->Invoices->findUnpaid($data);
            $term = 'Unpaid';
        }

        if (key_exists('outstanding', $query)) {
            $data = $this->Invoices->findOutstanding($data);
            $term = 'Outstanding';
        }

        $this->paginate = [
            'contain' => ['Users', 'Applications.Events'],
            'conditions' => ['Events.Live' => true],
            'order' => ['modified' => 'DESC'],
        ];

        if (!is_null($eventId)) {
            $data = $data->where(['Events.id' => $eventId]);
            $event = $this->Invoices->Applications->Events->get($eventId);
            $this->set(compact('event'));
        }
        $this->set(compact('term'));
        $this->set('invoices', $this->paginate($data));
        $this->set('_serialize', ['invoices']);
    }

    /**
     * View method
     *
     * @param string|null $invoiceId Invoice id.
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($invoiceId = null)
    {
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'Invoice_' . $invoiceId
            ]
        ]);

        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => [
                'Users',
                'Payments',
                'InvoiceItems',
                'Applications' => [
                    'Events' => [
                        'EventTypes' => [
                            'LegalTexts', 'InvoiceTexts', 'Payable'
                        ],
                        'AdminUsers',
                    ],
                    'Sections.Scoutgroups.Districts',
                ],
                'Notes'
            ]
        ]);

        $this->set(compact('invoice'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * @param null $invoiceId The ID of the Invoice
     *
     * @throws \Exception
     *
     * @return \Cake\Http\Response|void
     */
    public function pdfView($invoiceId = null)
    {
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'Invoice_' . $invoiceId
            ]
        ]);

        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => [
                'Users',
                'Payments',
                'InvoiceItems' => [
                    'conditions' => [
                        'visible' => 1
                    ]
                ],
                'Applications' => [
                    'Events' => [
                        'EventTypes' => [
                            'LegalTexts', 'InvoiceTexts', 'Payable'
                        ],
                        'AdminUsers',
                    ],
                    'Sections.Scoutgroups.Districts',
                ],
                'Notes' => [
                    'conditions' => [
                        'visible' => true
                    ]
                ]
            ]
        ]);

        $this->set(compact('invoice'));
        $this->set('_serialize', ['invoice']);

        $cakePDF = new \CakePdf\Pdf\CakePdf();
        $cakePDF->template('invoice', 'default');

        $cakePDF->write(FILES . DS . 'Event ' . $invoice->application->event->id . DS . 'Invoices' . DS . 'Invoice #' . $invoiceId . '.pdf');

        $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invoice->id, '_ext' => 'pdf']);
    }

    /**
     * @param int|null $invoiceId The ID of the Invoice
     *
     * @return \Cake\Http\Response|void
     *
     * @throws \Exception
     */
    public function sendPdf($invoiceId = null)
    {
        // Instantiate Objects
        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => ['Users', 'Payments', 'InvoiceItems' => ['conditions' => ['visible' => 1]], 'Applications']
        ]);

        $this->viewBuilder()->setOptions([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $invoiceId
               ]
           ]);

        /**
         * @var \App\Model\Entity\Application $application
         */
        $application = $this->Invoices->Applications->get($invoice->application_id);

        /**
         * @var \App\Model\Entity\Event $event
         */
        $event = $this->Invoices->Applications->Events->get($application->event_id, ['contain' => ['Applications', 'Settings']]);

        $this->set('_serialize', ['invoice']);

        $cakePDF = new \CakePdf\Pdf\CakePdf();
        $cakePDF->template('invoice', 'default');
        $this->set($cakePDF->viewVars());

        $cakePDF->write(FILES . DS . 'Event ' . $event->id . DS . 'Invoices' . DS . 'Invoice #' . $invoiceId . '.pdf');

        $this->redirect(['controller' => 'Notifications', 'action' => 'sendPdf', $invoice->id]);
    }

    /**
     * Add method.
     *
     * @param int|null $userId The Id of the User
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'view', $invoice->id]);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $users = $this->Invoices->Users->find(
            'list',
            [
                        'keyField' => 'id',
                        'valueField' => 'full_name',
                        'groupField' => 'scoutgroup.district.district'
            ]
        )
                    ->contain(['Scoutgroups.Districts']);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200]);

        // If User Set or Not - Limit the list.
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'order' => ['modified' => 'DESC']]);
        if (isset($userId) && !is_null($userId)) {
            $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userId]]);
        }

        $this->set(compact('invoice', 'users', 'payments', 'applications'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Edit method
     *
     * @param string|null $invoiceId Invoice id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($invoiceId = null)
    {
        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => ['Payments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'view', $invoice->id]);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }

        $users = $this->Invoices->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'section.scoutgroup.district.district'
            ]
        )
            ->contain(['Sections.Scoutgroups.Districts']);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200]);
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'order' => ['modified' => 'DESC']]);

        $this->set(compact('invoice', 'users', 'payments', 'applications'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Delete method
     *
     * @param string|null $invoiceId Invoice id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($invoiceId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($invoiceId);
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param int $invoiceId The Invoice ID
     * @return \Cake\Http\Response|void
     *
     * @throws \Exception
     */
    public function regenerate($invoiceId = null)
    {
        $query = $this->request->getQueryParams();

        $admin = false;
        if (key_exists('force', $query)) {
            $admin = true;
        }

        $this->loadComponent('Line');
        $parse = $this->Line->parseInvoice($invoiceId, $admin);

        if ($parse) {
            if ($admin) {
                $this->Flash->success('Invoice Regenerated from Application (bypassing limits).');
            } else {
                $this->Flash->success('Invoice Regenerated from Application.');
            }

            return $this->redirect($this->referer(['action' => 'view']));
        }

        $this->Flash->error('Issue Regenerating Invoice.');

        return $this->redirect($this->referer(['action' => 'view', $invoiceId]));
    }
}
