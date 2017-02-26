<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\DiscountForm;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{

    public function initialize()
    {
            parent::initialize();
            $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
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
        // Connect Registry
        $settings = TableRegistry::get('Settings');
        $events = TableRegistry::get('Events');
        $applications = TableRegistry::get('Applications');

        $this->viewBuilder()->options([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $id
               ]
           ]);

        // Insantiate Objects
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Users', 'Payments', 'InvoiceItems' => ['conditions' => ['visible' => 1]], 'Applications', 'Notes' => ['conditions' => ['visible' => true]]]
        ]);

        $application = $applications->get($invoice->application_id);

        $event = $events->get($application->event_id, ['contain' => ['Applications']]);

        // Set Address Variables
        $eventName = $event->full_name;
        $invAddress = $event->address;
        $invCity = $event->city;
        $invPostcode = $event->postcode;

        $this->set(compact('eventName', 'invAddress', 'invCity', 'invPostcode'));

        // Set Deadline Variable
        $invDeadline = $event->deposit_date;

        // Set Prefix Variable
        //$invSetPre = $event->invtext_id;
        //$invSetting = $settings->get($invSetPre);
        $invPrefix = '';

        // Set Payable Variable
        $invPayable = '';

        $this->set(compact('invoice', 'invPayable', 'invPrefix', 'invDeadline'));
        $this->set('_serialize', ['invoice']);
    }

    public function pdfView($id = null)
    {
        // Insantiate Objects
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Users', 'Payments', 'InvoiceItems' => ['conditions' => ['visible' => 1]], 'Applications']
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

        $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invoice->id, '_ext' => 'pdf']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     *
     * public function add()
     * {
     *    $invoice = $this->Invoices->newEntity();
     *    if ($this->request->is('post')) {
     *        $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
     *        if ($this->Invoices->save($invoice)) {
     *            $this->Flash->success(__('The invoice has been saved.'));
     *            return $this->redirect(['action' => 'index']);
     *        } else {
     *            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
     *        }
     *    }
     *    $users = $this->Invoices->Users->find('list', ['limit' => 200]);
     *    $payments = $this->Invoices->Payments->find('list', ['limit' => 200]);
     *    $this->set(compact('invoice', 'users', 'payments'));
     *    $this->set('_serialize', ['invoice']);
     * }*/

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
        $this->set(compact('invoice', 'users', 'payments'));
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


    public function generate($appId = null)
    {
        $apps = TableRegistry::get('Applications');
        $evts = TableRegistry::get('Events');
        $invs = TableRegistry::get('Invoices');

        $appCount = $apps->find('all')->where(['user_id' => $this->Auth->user('id')])->count('*');

        if ($appCount < 1) {
            $this->Flash->error(__('The Invoice cannot be generated without an Application. You have been redirected to create one first.'));

            return $this->redirect(['controller' => 'Applications', 'action' => 'newApp']);
        }

        // Only 1 Invoice to an App
        $existingInvs = $this->Invoices->find('all')->where(['application_id' => $appId]);
        $invCount = $existingInvs->count('*');
        $exist = $existingInvs->first();

        if ($invCount > 0) {
            $this->Flash->error(__('There is already an Invoice for this Application.'));

            return $this->redirect(['controller' => 'InvoiceItems', 'action' => 'repopulate', $exist->id]);
        }

        //Create Entities

        $invoice = $this->Invoices->newEntity();

        $newData = ['user_id' => $this->Auth->user('id')];

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Max Invoices on Event
            if (!isset($appId)) {
                $appId = $this->request->data['application_id'];
            }

            // Only 1 Invoice to an App
            $existingInvs = $this->Invoices->find('all')->where(['application_id' => $appId]);
            $invCount = $existingInvs->count('*');
            $exist = $existingInvs->first();

            if ($invCount > 0) {
                $this->Flash->error(__('There is already an Invoice for this Application.'));

                return $this->redirect(['controller' => 'InvoiceItems', 'action' => 'repopulate', $exist->id]);
            } else {
                $existingApp = $apps->get($appId);

                $eventInvs = $invs->find('all')->contain('Applications')->where(['Applications.event_id' => $existingApp->event_id]);
                $eventInvsCount = $eventInvs->count('*');

                $event = $evts->get($existingApp->event_id);
                $errorMsg = 'This event has been LOCKED to prevent updates to invoices. Please contact ' . $event->admin_full_name . '.';

                if ($eventInvsCount >= $event->available_apps && isset($event->available_apps) && $event->available_apps > 0) {
                    $this->Flash->error(__('The Maximum Number of Teams for this Event has been reached. The Event is Full.'));

                    return $this->redirect(['controller' => 'Events', 'action' => 'view', $event->id]);
                } elseif ($event->invoices_locked) {
                    $this->Flash->error(__($errorMsg));

                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', 'prefix' => false, $InvId]);
                } else {
                    $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);

                    $invoice = $this->Invoices->patchEntity($invoice, $newData);

                    if ($this->Invoices->save($invoice)) {
                        $redir = $invoice->get('id');

                        $this->Flash->success(__('An invoice has been generated. Please enter the number of Attendees you are bringing.'));

                        return $this->redirect(['controller' => 'InvoiceItems', 'action' => 'populate', $redir]);
                    } else {
                        $this->Flash->error(__('The invoice could not be generated. Please, try again.'));

                        return $this->redirect(['action' => 'index']);
                    }
                }
            }
        }

        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $this->set(compact('invoice', 'applications'));
        $this->set('_serialize', ['invoice']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['application_id'] = $appId;
        }




            //$this->set(compact('application', 'attendees', 'invoice', 'invoiceitems','payments'));
            //$this->set('_serialize', ['invoice', 'invoiceItem']);
        //}     else {
        //    return $this->redirect(['action' => 'index']);
        //}



        //if ($this->request->is('post')) {
        //    $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
        //    if ($this->Invoices->save($invoice)) {
        //        $this->Flash->success(__('The invoice has been saved.'));
        //        return $this->redirect(['action' => 'index']);
        //    } else {
        //        $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        //    }
        //}

        /*

        $users = $this->Invoices->Users->find('list', ['limit' => 200]);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200]);

        $this->set(compact('invoice', 'users', 'payments'));

        $this->set('_serialize', ['invoice']);*/
    }

    public function regenerate($InvId = null)
    {
        $invoiceItems = TableRegistry::get('InvoiceItems');
        $applications = TableRegistry::get('Applications');
        $events = TableRegistry::get('Events');

        //Get Entity

        $invoice = $this->Invoices->get($InvId, [
            'contain' => ['Users', 'Payments', 'InvoiceItems', 'Applications']
        ]);

        $itemCount = $invoiceItems->find()->where(['invoice_id' => $InvId])->count(['id']);
        $application = $applications->get($invoice->application_id);
        $event = $events->get($application->event_id);

        $errorMsg = 'This event has been LOCKED to prevent updates to invoices. Please contact ' . $event->admin_full_name . '.';

        if ($event->invoices_locked) {
            $this->Flash->error(__($errorMsg));

            return $this->redirect(['controller' => 'Invoices', 'action' => 'view', 'prefix' => false, $InvId]);
        } else {
            if ($itemCount >= 5) {
                $this->Flash->success(__('The invoice is valid. Please enter the number of attendees you are bringing.'));

                return $this->redirect(['controller' => 'InvoiceItems', 'action' => 'repopulate', $InvId]);
            } else {
                $this->Flash->success(__('An invoice has been generated. Please enter the number of attendees you are bringing.'));

                return $this->redirect(['controller' => 'InvoiceItems', 'action' => 'populate', $InvId]);
            }
        }
    }

    public function discount($invId = null)
    {
        $disForm = new DiscountForm();
        $this->set(compact('disForm'));

        $ints = TableRegistry::get('InvoiceItems');
        $dics = TableRegistry::get('Discounts');

        if ($this->request->is('post')) {
            $disCode = $this->request->data['discount'];

            if (isset($disCode) && strlen($disCode) >= 5 && strlen($disCode) <= 45) {
            // Check the code and match to a discount
                $discount = $dics->find('all')->where(['code' => $disCode])->first();

                if (isset($discount) && isset($invId)) {
                    $disValue = $discount->discount_value;
                    $disDescription = $discount->text;
                    $disQty = $discount->discount_number;

                    $disData = ['invoice_id' => $invId, 'Value' => $disValue, 'Description' => $disDescription, 'Quantity' => $disQty, 'itemtype_id' => 6, 'visible' => 1];
                    $disItem = $this->$ints->newEntity();
                    $disItem = $this->$ints->patchEntity($disItem, $disData);

                    $disUse = $discount->uses + 1;
                    $uses = ['uses' => $disUse];
                    $discount = $this->$dics->patchEntity($discount, $uses);

                    if ($this->$dics->save($discount) && $this->$ints->save($disItem)) {
                        $this->Flash->success(__('The Discount has been added to the Invoice.'));

                        return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
                    } else {
                        $this->Flash->error(__('There was an error.'));
                    }
                } else {
                    $this->Flash->error(__('The Discount Code was not recognised, please try again.'));

                    return $this->redirect(['Controller' => 'Invoices', 'action' => 'discount', $invId]);
                }
            } else {
                $this->Flash->error(__('Please enter a valid discount code.'));

                return $this->redirect(['Controller' => 'Invoices', 'action' => 'discount', $invId]);
            }
        }
    }

    public function sendFile($id)
    {
        $file = $this->Invoices->getFile($id);
        $this->response->file($file['path']);
        // Return response object to prevent controller from trying to render
        // a view.
        return $this->response;
    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['generate', 'index'])) {
            return true;
        }

        if (in_array($this->request->action, ['delete', 'edit'])) {
            return false;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['regenerate', 'view', 'discount'])) {
            $invoiceId = (int)$this->request->params['pass'][0];
            if ($this->Invoices->isOwnedBy($invoiceId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
