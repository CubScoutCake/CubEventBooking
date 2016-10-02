<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Utility\Hash;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Settings', 'Discounts']
            , 'order' => ['modified' => 'DESC']
        ];
        $this->set('events', $this->paginate($this->Events));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        if (isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if (isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if (isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }

        // Pass to View
        $this->set(compact('users', 'payments', 'discount', 'invText', 'legal'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));
    }

    public function fullView($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications', 'Applications.Users', 'Applications.Scoutgroups']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $itms = TableRegistry::get('InvoiceItems');
        $atts = TableRegistry::get('Attendees');
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');
        $usrs = TableRegistry::get('Users');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $apps->find('all')->where(['event_id' => $event->id]);
        $invoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        $allInvoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        if (isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if (isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if (isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }
        if (isset($event->admin_user_id)) {
            $administrator = $usrs->get($event->admin_user_id);
        }

        // Pass to View
        $this->set(compact('applications', 'users', 'payments', 'discount', 'invText', 'legal', 'administrator'));
        $this->set('invoices', $allInvoices);

        // Counts of Entities
        $cntApplications = $applications->count('*');
        $cntInvoices = $invoices->count('*');

        $this->set(compact('cntApplications', 'cntInvoices'));

        $sumValues = 0;
        $sumPayments = 0;
        $sumBalances = 0;

        $invCubs = 0;
        $invYls = 0;
        $invLeaders = 0;

        $outstanding = 0;

        if ($cntInvoices >= 1) {
            // Sum Values & Calculate Balances
            $sumValueItem = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->group('Applications.event_id')->first();
            $sumPaymentItem = $invoices->select(['sum' => $invoices->func()->sum('value')])->group('Applications.event_id')->first();

            $sumValues = $sumValueItem->sum;
            $sumPayments = $sumPaymentItem->sum;

            $sumBalances = $sumValues - $sumPayments;

            // Count of Line Items
            $invItemCounts = $itms->find('all')->contain(['Invoices.Applications'])->where(['Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity')])->group('itemtype_id')->toArray();

            $invCubs = $invItemCounts[1]->sum;
            $invYls = $invItemCounts[2]->sum;
            $invLeaders = $invItemCounts[3]->sum;

            //Find all Outstanding Invoices
            $outInvoices = $invs
                ->find('outstanding')
                ->contain(['Applications'])
                ->where(['Applications.event_id' => $event->id]);

            $unpaidInvoices = $invs
                ->find('outstanding')
                ->find('unpaid')
                ->contain(['Applications'])
                ->where(['Applications.event_id' => $event->id]);

            $outstanding = $outInvoices->count();
            $unpaid = $unpaidInvoices->count();

            if ($outstanding == 0) {
                $outInvoices = null;
            }
            if ($unpaid == 0) {
                $unpaidInvoices = null;
            }
            $this->set(compact('outInvoices', 'unpaidInvoices'));
        }

        $this->set(compact('sumValues', 'sumBalances', 'sumPayments', 'outstanding', 'unpaid'));
        $this->set(compact('invCubs', 'invYls', 'invLeaders'));

        if ($cntApplications < 1) {
            $appCubs = 0;
            $appYls = 0;
            $appLeaders = 0;
        } else {
            // Set Attendee Counts
            $attendeeCubCount = $applications->find('cubs');
            $attendeeYlCount = $applications->find('youngLeaders');
            $attendeeLeaderCount = $applications->find('leaders');
            
            // Count of Attendees
            $appCubs = $attendeeCubCount->count('*');
            $appYls = $attendeeYlCount->count('*');
            $appLeaders = $attendeeLeaderCount->count('*');
        }

        $this->set(compact('appCubs', 'appYls', 'appLeaders'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));

    }

    public function regList($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings'
            , 'Discounts'
            , 'Applications'
                , 'Applications.Invoices'
                , 'Applications.Attendees']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        if (isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if (isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if (isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }

        // Pass to View
        $this->set(compact('users', 'payments', 'discount', 'invText', 'legal'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));
    }

    public function accounts($id = null)
    {
    	$event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications', 'Applications.Users', 'Applications.Scoutgroups']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $itms = TableRegistry::get('InvoiceItems');
        $atts = TableRegistry::get('Attendees');
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');
        $usrs = TableRegistry::get('Users');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $apps->find('all')->where(['event_id' => $event->id]);
        $invoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        $allInvoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        if (isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if (isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if (isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }
        if (isset($event->admin_user_id)) {
            $administrator = $usrs->get($event->admin_user_id);
        }

        // Pass to View
        $this->set(compact('applications', 'users', 'payments', 'discount', 'invText', 'legal', 'administrator'));
        $this->set('invoices', $allInvoices);

        // Counts of Entities
        $cntApplications = $applications->count('*');
        $cntInvoices = $invoices->count('*');

        $this->set(compact('cntApplications', 'cntInvoices'));

        $sumValues = 0;
        $sumPayments = 0;
        $sumBalances = 0;

        $invCubs = 0;
        $invYls = 0;
        $invLeaders = 0;

        $canCubs = 0;
        $canYls = 0;
        $canLeaders = 0;

        $canValueCubs = 0;
        $canValueYls = 0;
        $canValueLeaders = 0;

        $outstanding = 0;

        if ($cntInvoices >= 1) {
            // Sum Values & Calculate Balances
            $sumValueItem = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->group('Applications.event_id')->first();
            $sumPaymentItem = $invoices->select(['sum' => $invoices->func()->sum('value')])->group('Applications.event_id')->first();

            $sumValues = $sumValueItem->sum;
            $sumPayments = $sumPaymentItem->sum;

            $sumBalances = $sumValues - $sumPayments;

            // Count of Line Items
            $invItemCounts = $itms->find('all')->contain(['Invoices.Applications'])->where(['Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity'),'value' => $invoices->func()->max('InvoiceItems.Value')])->group('itemtype_id')->toArray();

            $invCubs = $invItemCounts[1]->sum;
            $invYls = $invItemCounts[2]->sum;
            $invLeaders = $invItemCounts[3]->sum;

            $invValueCubs = $invItemCounts[1]->value * $invItemCounts[1]->sum;
            $invValueYls = $invItemCounts[2]->value * $invItemCounts[2]->sum;
            $invValueLeaders = $invItemCounts[3]->value * $invItemCounts[3]->sum;

            $this->set(compact('invItemCounts'));

            if (count($invItemCounts) > 6) {
                // Count of Cancelled Items
                $canItemCounts = $itms->find('all')->contain(['Invoices.Applications', 'Itemtypes'])->where(['Itemtypes.cancelled' => true, 'Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity'),'value' => $invoices->func()->max('InvoiceItems.Value')])->group('itemtype_id')->toArray();

                $canCubs = $canItemCounts[1]->sum;
                $canYls = $canItemCounts[2]->sum;
                $canLeaders = $canItemCounts[3]->sum;

                $canValueCubs = $canItemCounts[1]->value * $canItemCounts[1]->sum;
                $canValueYls = $canItemCounts[2]->value * $canItemCounts[2]->sum;
                $canValueLeaders = $canItemCounts[3]->value * $canItemCounts[3]->sum;

            }
            
            //Find all Outstanding Invoices
            $outInvoices = $invs
                ->find('outstanding')
                ->contain(['Applications'])
                ->where(['Applications.event_id' => $event->id]);

            $unpaidInvoices = $invs
                ->find('outstanding')
                ->find('unpaid')
                ->contain(['Applications'])
                ->where(['Applications.event_id' => $event->id]);

            $outstanding = $outInvoices->count();
            $unpaid = $unpaidInvoices->count();

            if ($outstanding == 0) {
                $outInvoices = null;
            }
            if ($unpaid == 0) {
                $unpaidInvoices = null;
            }          
        }

        $this->set(compact('outInvoices', 'unpaidInvoices'));
        $this->set(compact('invCubs', 'invYls', 'invLeaders', 'invValueCubs', 'invValueYls', 'invValueLeaders'));
        $this->set(compact('canCubs', 'canYls', 'canLeaders', 'canValueCubs', 'canValueYls', 'canValueLeaders'));
        $this->set(compact('sumValues', 'sumBalances', 'sumPayments', 'outstanding', 'unpaid'));        

        if ($cntApplications < 1) {
            $appCubs = 0;
            $appYls = 0;
            $appLeaders = 0;
        } else {
            // Set Attendee Counts
            $attendeeCubCount = $applications->find('cubs');
            $attendeeYlCount = $applications->find('youngLeaders');
            $attendeeLeaderCount = $applications->find('leaders');
            
            // Count of Attendees
            $appCubs = $attendeeCubCount->count('*');
            $appYls = $attendeeYlCount->count('*');
            $appLeaders = $attendeeLeaderCount->count('*');
        }

        $this->set(compact('appCubs', 'appYls', 'appLeaders'));
    }



    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $inv = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 4]]);
        $legal = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 3]]);
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $users = $this->Events->Users->find('list', ['limit' => 200, 'conditions' => ['authrole' => 'admin']]);
        $this->set(compact('event', 'inv', 'legal', 'discounts', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $inv = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 4]]);
        $legal = $this->Events->Settings->find('list', ['limit' => 200, 'conditions' => ['settingtype_id' => 3]]);
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $users = $this->Events->Users->find('list', ['limit' => 200, 'conditions' => ['authrole' => 'admin']]);
        $this->set(compact('event', 'inv', 'legal', 'discounts', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
