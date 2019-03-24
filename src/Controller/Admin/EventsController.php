<?php
namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Controller\Component\AvailabilityComponent $Availability
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
            'contain' => ['Settings', 'Discounts'],
            'order' => ['modified' => 'DESC']
        ];
        $this->set('events', $this->paginate($this->Events));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $eventId Event id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($eventId = null)
    {
        $event = $this->Events->get($eventId, [
            'contain' => [
                'Discounts',
                'AdminUsers',
                'Applications' => [
                    'Sections.Scoutgroups.Districts'
                ],
                'EventTypes' => [
                    'LegalTexts',
                    'Payable',
                    'ApplicationRefs',
                    'InvoiceTexts'
                ],
                'SectionTypes.Roles',
                'Prices.ItemTypes.Roles',
            ]
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        $lineQuery = $this->Events->Applications->find('all', ['contain' => ['Sections.Scoutgroups.Districts']])
            ->where(['event_id' => $eventId]);

        $lineQuery = $lineQuery->select([
                'value' => $lineQuery->func()->count('*'),
                'label' => 'Districts.district'
            ])
            ->group('Districts.district');

        $lineArray = $lineQuery->enableHydration(false)->toArray();

        $lineArray = Hash::remove($lineArray, '[virtual]');

        $lineArray = json_encode($lineArray);

        $this->set(compact('lineArray'));

        $maxSection = $this->Events->getPriceSection($eventId);

        $term = $event->event_type->application_ref->text;
        $singleTerm = $term;
        $pluralTerm = Inflector::pluralize($term);

        if (($event->max_apps - $event->cc_apps) > 1) {
            $term = $pluralTerm;
        }

        // Pass to View
        $this->set(compact('term', 'singleTerm', 'maxSection', 'pluralTerm'));
    }

    /**
     * @param null $eventId The ID of the Event
     *
     * @throws \Exception
     *
     * @return void
     */
    public function accounts($eventId = null)
    {
        $event = $this->Events->get($eventId, [
            'contain' => ['Settings', 'Discounts', 'Prices.ItemTypes', 'Applications', 'Applications.Users', 'Applications.Sections.Scoutgroups.Districts']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $itms = TableRegistry::get('InvoiceItems');
        $sets = TableRegistry::get('Settings');
        $dscs = TableRegistry::get('Discounts');
        $usrs = TableRegistry::get('Users');

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
        $this->set(compact('applications', 'discount', 'invText', 'legal', 'administrator'));
        $this->set('invoices', $allInvoices);

        // Counts of Entities
        $cntApplications = $applications->count();
        $cntInvoices = $invoices->count();

        $this->set(compact('cntApplications', 'cntInvoices'));

        // Get Attendee Counts
        $this->loadComponent('Availability');
        $numbers = $this->Availability->getEventNumbers($eventId);

        // Count of Attendees
        $appCubs = $numbers['NumSection'];
        $appYls = $numbers['NumNonSection'];
        $appLeaders = $numbers['NumLeaders'];

        $this->set(compact('appCubs', 'appYls', 'appLeaders'));

        $sumValues = 0;
        $sumPayments = 0;
        $sumBalances = 0;

        $invCubs = 0;
        $invYls = 0;
        $invLeaders = 0;

        $invValueCubs = 0;
        $invValueYls = 0;
        $invValueLeaders = 0;

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
            $invItemCounts = $itms->find('all')->contain(['Invoices.Applications'])->where(['Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('quantity'), 'value' => $invoices->func()->max('InvoiceItems.value')])->group('item_type_id')->toArray();

            $invCubs = $invItemCounts[1]->sum;
            $invYls = $invItemCounts[2]->sum;
            $invLeaders = $invItemCounts[3]->sum;

            $invValueCubs = $invItemCounts[1]->value * $invItemCounts[1]->sum;
            $invValueYls = $invItemCounts[2]->value * $invItemCounts[2]->sum;
            $invValueLeaders = $invItemCounts[3]->value * $invItemCounts[3]->sum;

            $this->set(compact('invItemCounts'));

            if (count($invItemCounts) > 6) {
                // Count of Cancelled Items
                $canItemCounts = $itms->find('all')->contain(['Invoices.Applications', 'Itemtypes'])->where(['Itemtypes.cancelled' => true, 'Applications.event_id' => $event->id])->select(['sum' => $invoices->func()->sum('Quantity'), 'value' => $invoices->func()->max('InvoiceItems.Value')])->group('item_type_id')->toArray();

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
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|mixed Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();

        if ($this->request->is('post')) {
            $eventData = $this->request->getData();
            $event = $this->Events->patchEntity($event, $eventData);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $eventTypes = $this->Events->EventTypes->find('list', ['limit' => 200]);
        $sectionTypes = $this->Events->SectionTypes->find('list', ['limit' => 200]);
        $users = $this->Events->AdminUsers->find('list', ['limit' => 200, 'contain' => 'AuthRoles', 'conditions' => ['AuthRoles.admin_access' => true]]);
        $this->set(compact('event', 'eventTypes', 'discounts', 'users', 'sectionTypes'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $eventId Event id.
     *
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($eventId = null)
    {
        $event = $this->Events->get($eventId, [
            'contain' => ['Settings']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $eventTypes = $this->Events->EventTypes->find('list', ['limit' => 200]);
        $sectionTypes = $this->Events->SectionTypes->find('list', ['limit' => 200]);
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $users = $this->Events->AdminUsers->find('list', ['limit' => 200, 'contain' => 'AuthRoles', 'conditions' => ['AuthRoles.admin_access' => true]]);
        $this->set(compact('event', 'eventTypes', 'sectionTypes', 'discounts', 'users'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Team Prices Function
     *
     * @param int $eventId The ID of the event to be set to Event
     *
     * @return \Cake\Http\Response|mixed
     */
    public function teamPrices($eventId = null)
    {
        if (is_null($eventId)) {
            return $this->redirect($this->referer(['action' => 'prices']));
        }

        $event = $this->Events->get($eventId, ['contain' => 'Prices.ItemTypes']);
        $event->set('team_price', true);

        foreach ($event->prices as $price) {
            if (!$price->item_type->team_price) {
                $this->Events->Prices->delete($price);
            }
        }

        if ($this->Events->save($event)) {
            $this->Flash->success(__('The Event is Set to Team Pricing.'));

            return $this->redirect(['action' => 'prices', $eventId]);
        }
        $this->Flash->error(__('The Event could not be set to Team Pricing.'));

        return $this->redirect($this->referer(['action' => 'prices']));
    }

    /**
     * Application Prices Function
     *
     * @param int $eventId The ID of the event to be set to Event
     *
     * @return \Cake\Http\Response
     */
    public function applicationPrices($eventId = null)
    {
        if (is_null($eventId)) {
            return $this->redirect($this->referer(['action' => 'prices']));
        }

        $event = $this->Events->get($eventId, ['contain' => 'Prices.ItemTypes']);
        $event->set('team_price', false);

        foreach ($event->prices as $price) {
            if ($price->item_type->team_price) {
                $this->Events->Prices->delete($price);
            }
        }

        if ($this->Events->save($event)) {
            $this->Flash->success(__('The Event is Set to Application Pricing.'));

            return $this->redirect(['action' => 'prices', $eventId]);
        }
        $this->Flash->error(__('The Event could not be set to Application Pricing.'));

        return $this->redirect($this->referer(['action' => 'prices']));
    }

    /**
     * Edit method
     *
     * @param string|null $eventId Event id.
     * @param int $additional Number of Prices to be Created.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Exception
     */
    public function prices($eventId = null, $additional = 0)
    {
        if ($this->request->getData('additional')) {
            return $this->redirect(['action' => 'prices', $eventId, $this->request->getData('boxes')]);
        }
        $event = $this->Events->get($eventId, [
            'contain' => ['Settings', 'Prices']
        ]);
        $prices = count($event->prices);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity(
                $event,
                $this->request->getData(),
                ['associated' => [ 'Prices']]
            );
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                if ($this->Events->determineComplete($event->id)) {
                    $this->log('Event #' . $event->id . ' (' . $event->name . ') was completed.', 'info');

                    $this->Flash->success('Event was marked Completed.');
                }

                return $this->redirect(['action' => 'prices', $eventId]);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }

        $itemTypeOptions = $this->Events->Prices->ItemTypes->find('list')->where(['team_price' => false]);
        if ($event->team_price) {
            $itemTypeOptions = $this->Events->Prices->ItemTypes->find('list')->where(['team_price' => true]);
        }

        $this->set(compact('prices', 'additional', 'event', 'itemTypeOptions'));

        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $eventId Event id.
     * @param int $additional Number of Prices to be Created.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Exception
     */
    public function logistics($eventId = null, $additional = 0)
    {
        if ($this->request->getData('additional')) {
            return $this->redirect(['action' => 'logistics', $eventId, $this->request->getData('boxes')]);
        }
        $event = $this->Events->get($eventId, [
            'contain' => ['Settings', 'Logistics' => ['Parameters' => [ 'Params', 'ParameterSets']]],
        ]);
        $logisticsCount = count($event->logistics);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity(
                $event,
                $this->request->getData(),
                ['associated' => [ 'Logistics']]
            );
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                if ($this->Events->determineComplete($event->id)) {
                    $this->log('Event #' . $event->id . ' (' . $event->name . ') was completed.', 'info');

                    $this->Flash->success('Event was marked Completed.');
                }

                return $this->redirect(['action' => 'logistics', $eventId]);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }

        $parameters = $this->Events->Logistics->Parameters->find('list');

        $this->set(compact('logisticsCount', 'additional', 'event', 'parameters'));

        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $eventId Event id.
     *
     * @return \Cake\Http\Response Redirects to index.
     *
     * @throws \Exception When record not found.
     */
    public function delete($eventId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($eventId);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer(['action' => 'index']));
    }

    /**
     * @param int $eventID The event to be Exported.
     *
     * @return \Cake\Http\Response|void
     */
    public function export($eventID)
    {
        $events = $this->Events->Applications->find('all', ['contain' => ['Sections.Scoutgroups.Districts', 'Users']])->where(['Applications.event_id' => $eventID])->toArray();
        $_serialize = 'events';
        $_header = ['App ID', 'Section', 'PermitHolder', 'TeamLeader', 'Created', 'User', 'Email', 'Scout Group', 'District'];

        $_extract = [
            'id',
            'section.section',
            'permit_holder',
            'team_leader',
            'created',
            'user.full_name',
            'user.email',
            'section.scoutgroup.scoutgroup',
            'section.scoutgroup.district.district',
        ];

        $this->set(compact('events', '_serialize', '_extract', '_header'));

        $fileName = 'Event ' . $eventID . ' Applications' . '.csv';
        $this->response->withDownload($fileName);

        $this->viewBuilder()->setClassName('CsvView.Csv');
    }
}
