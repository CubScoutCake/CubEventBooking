<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

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
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Applications.Events']
            , 'conditions' => ['Events.Live' => true]
            , 'order' => ['modified' => 'DESC']
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
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'Invoice_' . $id
            ]
        ]);

        $invoice = $this->Invoices->get($id, [
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
                        ]
                    ],
                    'Sections.Scoutgroups.Districts',
                ],
                'Notes'
            ]
        ]);

        $this->set(compact('invoice'));
        $this->set('_serialize', ['invoice']);
    }

    public function pdfView($id = null)
    {
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'Invoice_' . $id
            ]
        ]);

        $invoice = $this->Invoices->get($id, [
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
                        ]
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

        $CakePdf = new \CakePdf\Pdf\CakePdf();
        $CakePdf->template('invoice', 'default');
        $CakePdf->viewVars($this->viewVars);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Invoices' . DS . 'Invoice #' . $id . '.pdf');

        $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invoice->id, '_ext' => 'pdf']);
    }

    public function eventPdf($eventId = null)
    {
        if (isset($eventId)) {
            // Connect Registry
            $settings = TableRegistry::get('Settings');
            $events = TableRegistry::get('Events');
            $applications = TableRegistry::get('Applications');

            $event = $events->get($eventId, ['contain' => ['Applications.Invoices', 'Settings']]);

            foreach ($event->applications as $applications) {
                $invoiceFirst = $this->Invoices->find('all')->where(['application_id' => $applications->id])->first();

                // Insantiate Objects
                $invoice = $this->Invoices->get($invoiceFirst->id, [
                    'contain' => ['Users', 'Payments', 'InvoiceItems' => ['conditions' => ['visible' => 1]], 'Applications']
                ]);

                $this->viewBuilder()->options([
                       'pdfConfig' => [
                           'orientation' => 'portrait',
                           'filename' => 'Invoice #' . $invoice->id
                       ]
                   ]);

                // Set Address Variables
                $eventName = $event->full_name;
                $invAddress = $event->address;
                $invCity = $event->city;
                $invPostcode = $event->postcode;

                $this->set(compact('eventName', 'invAddress', 'invCity', 'invPostcode'));

                // Set Deadline Variable
                $invDeadline = $event->deposit_date;

                // Set Prefix Variable
                $invSetPre = $event->invtext_id;
                $invSetting = $settings->get($invSetPre);
                $invPrefix = $invSetting->text;

                // Set Payable Variable
                $invPayable = $settings->get(4)->text;

                $this->set(compact('invoice', 'invPayable', 'invPrefix', 'invDeadline'));
                $this->set('_serialize', ['invoice']);

                $CakePdf = new \CakePdf\Pdf\CakePdf();
                $CakePdf->template('invoice', 'default');
                $CakePdf->viewVars($this->viewVars);
                // Get the PDF string returned
                $pdf = $CakePdf->output();
                // Or write it to file directly
                $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Invoices' . DS . 'Invoice #' . $invoice->id . '.pdf');
            }
        }

        $this->redirect(['controller' => 'Events', 'action' => 'full_view', $event->id]);
    }

    public function sendPdf($id = null)
    {
        // Insantiate Objects
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Users', 'Payments', 'InvoiceItems' => ['conditions' => ['visible' => 1]], 'Applications']
        ]);

        $this->viewBuilder()->options([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $id
               ]
           ]);

        // Connect Registry
        $settings = TableRegistry::get('Settings');
        $events = TableRegistry::get('Events');
        $applications = TableRegistry::get('Applications');

        $application = $applications->get($invoice->application_id);

        $event = $events->get($application->event_id, ['contain' => ['Applications', 'Settings']]);

        // Set Address Variables
        $eventName = $event->full_name;
        $invAddress = $event->address;
        $invCity = $event->city;
        $invPostcode = $event->postcode;

        $this->set(compact('eventName', 'invAddress', 'invCity', 'invPostcode'));

        // Set Deadline Variable
        $invDeadline = $event->deposit_date;

        // Set Prefix Variable
        $invSetPre = $event->invtext_id;
        $invSetting = $settings->get($invSetPre);
        $invPrefix = $invSetting->text;

        // Set Payable Variable
        $invPayable = $settings->get(4)->text;

        $this->set(compact('invoice', 'invPayable', 'invPrefix', 'invDeadline'));
        $this->set('_serialize', ['invoice']);

        $CakePdf = new \CakePdf\Pdf\CakePdf();
        $CakePdf->template('invoice', 'default');
        $CakePdf->viewVars($this->viewVars);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Invoices' . DS . 'Invoice #' . $id . '.pdf');

        $this->redirect(['controller' => 'Notifications', 'action' => 'sendPdf', $invoice->id]);
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
        if (isset($userId)) {
            $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userId]]);
        }

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

    /**
     * @param int $InvId The Invoice ID
     * @return \Cake\Http\Response|null
     */
    public function regenerate($InvId = null)
    {
        $this->loadComponent('Line');
        $parse = $this->Line->parseInvoice($InvId);

        if ($parse) {
            $this->Flash->success('Invoice Regenerated from Application.');

            return $this->redirect($this->referer(['action' => 'view']));
        }

        $this->Flash->error('Issue Regenerating Invoice.');

        return $this->redirect($this->referer(['action' => 'view', $InvId]));
    }

    /**
     * @param int $invoiceId The Invoice ID
     * @return \Cake\Http\Response
     */
    public function sendFile($invoiceId)
    {
        $file = $this->Invoices->getFile($invoiceId);
        $this->response->file($file['path']);
        // Return response object to prevent controller from trying to render a view.
        return $this->response;
    }

    /*public function isAuthorized($user)
    {
        $auth = $user->authrole;

        // All registered users can add articles
        if (isset($this->Auth->user('authrole') && $this->Auth->user('authrole') === 'admin')) {
            return true;
        } else {
            return false;
        }


        return parent::isAuthorized($user);
    }*/
}
