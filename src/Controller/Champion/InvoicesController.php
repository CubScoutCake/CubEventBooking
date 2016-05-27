<?php
namespace App\Controller\Champion;

use App\Controller\Champion\AppController;
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
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));
        
        $this->paginate = [
            'contain' => ['Users', 'Applications', 'Applications.Scoutgroups']
            ,'conditions' => ['Scoutgroups.district_id' => $champD->district_id]
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

        // Insantiate Objects
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Users', 'Payments', 'InvoiceItems', 'Applications']
        ]);

        $application = $applications->get($invoice->application_id);

        $event = $events->get($application->event_id, ['contain' => ['Applications', 'Settings']]);

        // Set Address Variables
        $eventName = $event->full_name;
        $invAddress = $event->address;
        $invCity = $event->city;
        $invPostcode = $event->postcode;

        $this->set('eventName', $eventName);
        $this->set('invAddress', $invAddress);
        $this->set('invCity', $invCity);
        $this->set('invPostcode', $invPostcode);

        // Set Deadline Variable
        $invDeadline = $event->deposit_date;
        $this->set('invDeadline', $invDeadline);

        // Set Prefix Variable
        $invSetPre = $event->invtext_id;
        $invSetting = $settings->get($invSetPre);
        $invPrefix = $invSetting->text;
        //$invPrefix = $invSetPre;

        $this->set('invPrefix', $invPrefix);

        // Set Payable Variable
        $payableSetting = $settings->get(4);
        $invPayable = $payableSetting->text;

        $this->set('invPayable', $invPayable);

        //if($count) {
        //    return $this->redirect(['action' => 'index'])
        //}


        //Generate Cubs Line Items

        //$invoiceCubs = $this->InvoiceItems->newEntity();

        //$newCubs = ['user_id' => $this->Auth->user('id'), 'modification' => 0, 'eventname' => 'HertsCubs100'];
        //$invoiceCubs = $this->InvoiceItems->patchEntity($invoiceCubs, $newCubs);

        //$this->Invoices->save($invoiceCubs);


        /*$applications = TableRegistry::get('applications');

        $query = $this->Attendees->find();

        $query->innerJoinWith('Tags', function ($q) {
            return $q->where(['Tags.name' => 'CakePHP']);
        }); */        

        $this->set('invoice', $invoice);
        $this->set('_serialize', ['invoice']);

    }

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

        $users = $this->Invoices->Users->find('list', ['limit' => 200, 'conditions' => ['id' => $userThis]]);
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userThis]]);

        $this->set(compact('invoice', 'users', 'applications'));
        $this->set('_serialize', ['invoice']);
    }

    public function generate($appId = null, $userId = null)
    {
        $apps = TableRegistry::get('Applications');

        //Create Entities

        $invoice = $this->Invoices->newEntity();

        $newData = ['user_id' => $userId];

        if ($this->request->is(['patch', 'post', 'put'])) {

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

        if (isset($userId)) {
            $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userId]]);
        } else {
            $applications = $this->Invoices->Applications->find('list', ['limit' => 200]);
        }

        $this->set(compact('applications'));    
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

        //Get Entity
        $invoice = $this->Invoices->get($InvId, [
            'contain' => ['Users', 'Payments', 'InvoiceItems', 'Applications']
        ]);

        $itemCount = $invoiceItems->find()->where(['invoice_id' => $InvId])->count(['id']);

        if ($this->Invoices->save($invoice)) {
            if ($itemCount == 5) {
                $this->Flash->success(__('The invoice is valid. Please enter the number of Attendees you are bringing.'));
                return $this->redirect(['prefix' => 'champion', 'controller' => 'InvoiceItems', 'action' => 'repopulate', $InvId]);
            } else {
                $this->Flash->success(__('An invoice has been generated. Please enter the number of Attendees you are bringing.'));
                return $this->redirect(['prefix' => 'champion', 'controller' => 'InvoiceItems', 'action' => 'populate', $InvId]);
            }
        } else {
            $this->Flash->error(__('The invoice could not be regenerated. Please, try again.'));
            return $this->redirect(['Controller' => 'Invoices', 'action' => 'view', $InvId]);
        }
    }
}
