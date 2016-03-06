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

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
                $this->Flash->success(__('The invoice has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $users = $this->Invoices->Users->find('list', ['limit' => 200, 'contain' => 'Scoutgroups', 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'contain' => ['Users','Users.Scoutgroups'], 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200, 'contain' => ['Users.Scoutgroups'], 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        $this->set(compact('invoice', 'users', 'payments', 'applications'));
        $this->set('_serialize', ['invoice']);
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
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

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
        $users = $this->Invoices->Users->find('list', ['limit' => 200, 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        $applications = $this->Invoices->Applications->find('list', ['limit' => 200, 'conditions' => ['Users.Scoutgroups.district_id' => $champD->district_id]]);
        $payments = $this->Invoices->Payments->find('list', ['limit' => 200, 'conditions' => ['Users.Scoutgroups.district_id' => $champD->district_id]]);
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
}
