<?php
namespace App\Controller\Champion;

use App\Controller\Champion\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

     public function index()
    {
        $this->paginate = [
            'contain' => ['Settings', 'Discounts']
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
        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $itms = TableRegistry::get('InvoiceItems');
        $atts = TableRegistry::get('Attendees');
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');
        $grps = TableRegistry::get('Scoutgroups');
        
        $champD = $grps->get($this->Auth->user('scoutgroup_id'));
        
        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications']]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        $applications = $apps->find('all')->where(['event_id' => $event->id]);
        $invoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        if(isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if(isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if(isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }

        // Pass to View
        $this->set(compact('users', 'payments', 'discount', 'invText', 'legal'));

        // Counts of Entities
        $cntApplications = $applications->count('*');
        $cntInvoices = $invoices->count('*');

        // Sum Values & Calculate Balances
        $sumValues = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->group('Applications.event_id')->first();
        $sumPayments = $invoices->select(['sum' => $invoices->func()->sum('value')])->group('Applications.event_id')->first();

        $sumBalances = $sumValues->sum - $sumPayments->sum;
        
        $this->set(compact('cntApplications', 'cntInvoices', 'sumValues', 'sumBalances', 'sumPayments'));

        // Count of Line Items
        $invItemCounts = $itms->find('all')->contain(['Invoices.Applications'])->where(['Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity')])->group('itemtype_id')->toArray();

        $invCubs = $invItemCounts[1]->sum;
        $invYls = $invItemCounts[2]->sum;
        $invLeaders = $invItemCounts[3]->sum;        

        $this->set(compact('invCubs', 'invYls', 'invLeaders'));

        // Set Attendee Counts
        $attendeeCubCount = $apps->find('all')
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.event_id' => $id]);

        $attendeeYlCount = $apps->find('all')
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.event_id' => $id]);

        $attendeeLeaderCount = $apps->find('all')
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.event_id' => $id]);

        // Count of Attendees
        $appCubs = $attendeeCubCount->count('*');
        $appYls = $attendeeYlCount->count('*');
        $appLeaders = $attendeeLeaderCount->count('*');

        $this->set(compact('appCubs', 'appYls', 'appLeaders'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));
    }

    public function fullView($id = null)
    {
        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $itms = TableRegistry::get('InvoiceItems');
        $atts = TableRegistry::get('Attendees');
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');
        $usrs = TableRegistry::get('Users');
        $grps = TableRegistry::get('Scoutgroups');

        $now = Time::now();
        $userId = $this->Auth->user('id');
        $champD = $grps->get($this->Auth->user('scoutgroup_id'));

        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications', 'Applications.Users', 'Applications.Scoutgroups' => ['conditions' => ['Scoutgroups.district_id' => $champD->district_id]]]
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
        
        // Table Entities
        $applications = $apps->find('all')->contain(['Scoutgroups'])->where(['event_id' => $event->id, 'Scoutgroups.district_id' => $champD->district_id]);
        $invoices = $invs->find('all')->contain(['Applications'])->where(['Applications.event_id' => $event->id]);
        $allInvoices = $invs->find('all')->contain(['Applications', 'Applications.Scoutgroups'])->where(['Applications.event_id' => $event->id, 'Scoutgroups.district_id' => $champD->district_id]);
        if(isset($event->discount_id)) {
            $discount = $dscs->get($event->discount_id);
        }
        if(isset($event->legaltext_id)) {
            $legal = $sets->get($event->legaltext_id);
        }
        if(isset($event->invtext_id)) {
            $invText = $sets->get($event->invtext_id);
        }
        if(isset($event->admin_user_id)) {
            $administrator = $usrs->get($event->admin_user_id);
        }

        // Pass to View
        $this->set(compact('applications', 'users', 'payments', 'discount', 'invText', 'legal', 'administrator'));
        $this->set('invoices', $allInvoices);

        // Counts of Entities
        $cntApplications = $applications->count('*');
        $cntInvoices = $invoices->count('*');

        // Sum Values & Calculate Balances
        $sumValues = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->group('Applications.event_id')->first();
        $sumPayments = $invoices->select(['sum' => $invoices->func()->sum('value')])->group('Applications.event_id')->first();

        $sumBalances = $sumValues->sum - $sumPayments->sum;
        
        $this->set(compact('cntApplications', 'cntInvoices', 'sumValues', 'sumBalances', 'sumPayments'));

        // Count of Line Items
        $invItemCounts = $itms->find('all')->contain(['Invoices.Applications'])->where(['Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity')])->group('itemtype_id')->toArray();

        $invCubs = $invItemCounts[1]->sum;
        $invYls = $invItemCounts[2]->sum;
        $invLeaders = $invItemCounts[3]->sum;        

        $this->set(compact('invCubs', 'invYls', 'invLeaders'));

        // Set Attendee Counts
        $attendeeCubCount = $apps->find('all')
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.event_id' => $id]);

        $attendeeYlCount = $apps->find('all')
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.event_id' => $id]);

        $attendeeLeaderCount = $apps->find('all')
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.event_id' => $id]);

        // Count of Attendees
        $appCubs = $attendeeCubCount->count('*');
        $appYls = $attendeeYlCount->count('*');
        $appLeaders = $attendeeLeaderCount->count('*');

        $this->set(compact('appCubs', 'appYls', 'appLeaders'));

        // Set Logo Dimensions
        $setting = $sets->get(7);
        $logoSet = $setting->text;
        $logoHeight = $logoSet;
        $logoWidth = $logoSet / $event->logo_ratio;
        $this->set(compact('logoWidth', 'logoHeight'));

    }
}
