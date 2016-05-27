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
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Invoices'],
            'conditions' => ['Invoices.user_id' => $this->Auth->user('id')]
        ];
        $this->set('invoiceItems', $this->paginate($this->InvoiceItems));
        $this->set('_serialize', ['invoiceItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Item id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceItem = $this->InvoiceItems->get($id, [
            'contain' => ['Invoices' => ['conditions' => ['user_id' => $this->Auth->user('id')]]]
        ]);
        $this->set('invoiceItem', $invoiceItem);
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $invoiceItem = $this->InvoiceItems->newEntity();
    //     if ($this->request->is('post')) {
    //         $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->data);
    //         if ($this->InvoiceItems->save($invoiceItem)) {
    //             $this->Flash->success(__('The invoice item has been saved.'));
    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
    //         }
    //     }
    //     $invoices = $this->InvoiceItems->Invoices->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
    //     $this->set(compact('invoiceItem', 'invoices'));
    //     $this->set('_serialize', ['invoiceItem']);
    // }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Item id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $invoiceItem = $this->InvoiceItems->get($id, [
    //         'contain' => []
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->data);
    //         if ($this->InvoiceItems->save($invoiceItem)) {
    //             $this->Flash->success(__('The invoice item has been saved.'));
    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
    //         }
    //     }
    //     $invoices = $this->InvoiceItems->Invoices->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
    //     $this->set(compact('invoiceItem', 'invoices'));
    //     $this->set('_serialize', ['invoiceItem']);
    // }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Item id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $invoiceItem = $this->InvoiceItems->get($id);
    //     if ($this->InvoiceItems->delete($invoiceItem)) {
    //         $this->Flash->success(__('The invoice item has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The invoice item could not be deleted. Please, try again.'));
    //     }
    //     return $this->redirect(['action' => 'index']);
    // }

    public function populate($invID = null)
    {
        // Connect Registry
        $settings = TableRegistry::get('Settings');
        $events = TableRegistry::get('Events');
        $applications = TableRegistry::get('Applications');
        $attendees = TableRegistry::get('Attendees');
        $invoices = TableRegistry::get('Invoices');

        // Insantiate Objects
        $invoice = $invoices->get($invID, [
            'contain' => ['Users', 'Payments', 'InvoiceItems', 'Applications']
        ]);

        $application = $applications->get($invoice->application_id, [
            'contain' => ['Attendees']
        ]);

        $event = $events->get($application->event_id, ['contain' => ['Applications', 'Settings', 'Discounts', 'Users']]);

        $errorMsg = 'This event has been LOCKED to prevent updates to invoices. Please contact ' . $event->admin_full_name . '.';

        if ($event->invoices_locked) {
            $this->Flash->error(__($errorMsg));
            return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
        }

        // Set Values for Options
        $CubsVis = $event->cubs;
        $YlsVis = $event->yls;
        $LeadersVis = $event->leaders;

        $this->set(compact('CubsVis', 'YlsVis', 'LeadersVis'));

        // Set Item Description Text
        $depositDescription = $event->deposit_text;
        $cubsDescription = $event->cubs_text;
        $ylsDescription = $event->yls_text;
        $leadersDescription = $event->leaders_text;

        // Set Item Price
        $depositEventPrice = $event->deposit_value;
        $cubsEventPrice = $event->cubs_value;
        $ylsEventPrice = $event->yls_value;
        $leadersEventPrice = $event->leaders_value;

        // Set Application ID
        $appID = $invoice->application_id;

        // Set Attendee Counts
        $attendeeCubCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $appID, 't.deleted IS' => NULL]);

        $attendeeYlCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $appID, 't.deleted IS' => NULL]);

        $attendeeLeaderCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.id' => $appID, 't.deleted IS' => NULL]);

        // Load into Variables
        $predictedCubs = $attendeeCubCount->count(['t.id']);
        $predictedYls = $attendeeYlCount->count(['t.id']);
        $predictedLeaders = $attendeeLeaderCount->count(['t.id']);

        // Set Variable for the Modeless Form to take Values
        $invPop = new InvForm();
        $limitTextCubs = 'There is a limit for Cubs on this event.';
        $limitTextYls = 'There is a limit for Young Leaders on this event.';
        $limitTextLeaders = 'There is a limit for Leaders on this event.';

        // Create Entities
        $cubItem = $this->InvoiceItems->newEntity();
        $depCubItem = $this->InvoiceItems->newEntity();

        $yLItem = $this->InvoiceItems->newEntity();
        // $depYLItem = $this->InvoiceItems->newEntity();

        $leaderItem = $this->InvoiceItems->newEntity();
        // $depLeaderItem = $this->InvoiceItems->newEntity();

        if ($this->request->is('post')) {

            // Extract Form Info
            if ($event->cubs) {
                $formNumCubs = $this->request->data['cubs'];
            } else {
                $formNumCubs = 0;
            }
            
            if ($event->yls) {
                $formNumYls = $this->request->data['yls'];
            } else {
                $formNumYls = 0;
            }

            if ($event->leaders) {
                $formNumLeaders = $this->request->data['leaders'];
            } else {
                $formNumLeaders = 0;
            }

            // Compare Form Info - Cubs
            if ($event->max && $formNumCubs > $event->max_cubs) {
                $numCubs = $event->max_cubs;
                $this->Flash->error(__($limitTextCubs));
            } else {
                $numCubs = $formNumCubs;
            }


            // Compare Form Info - YLs
            if ($event->max && $formNumYls > $event->max_yls) {
                $numYls = $event->max_yls;
                $this->Flash->error(__($limitTextYls));
            } else {
                $numYls = $formNumYls;
            }


            // Compare Form Info - Leaders
            if ($event->max && $formNumLeaders > $event->max_leaders) {
                $numLeaders = $event->max_leaders;
                $this->Flash->error(__($limitTextLeaders));
            } else {
                $numLeaders = $formNumLeaders;
            }

            // Patch Items with Deposit Invoices
            if ($event->deposit) {
                $depValue = $event->deposit_value;
                $depDescription = $event->deposit_text;
                if ($event->deposit_inc_leaders) {
                    $depNum = $numCubs + $numLeaders + $numYls;
                } else {
                    $depNum = $numCubs;
                }
            } else {
                $depValue = 0;
                $depDescription = 'No Deposit Required';
                $depNum = 0;
            }

            $cubDeposit = ['invoice_id' => $invID, 'Value' => $depValue, 'Description' => $depDescription, 'Quantity' => $depNum, 'itemtype_id' => 1, 'visible' => $event->deposit];
            $depCubItem = $this->InvoiceItems->patchEntity($depCubItem, $cubDeposit);

            // Patch Items with Standard Info
            $cubStandard = ['invoice_id' => $invID, 'Value' => $cubsEventPrice, 'Description' => $cubsDescription, 'Quantity' => $numCubs, 'itemtype_id' => 2, 'visible' => $event->cubs];
            $ylStandard = ['invoice_id' => $invID, 'Value' => $ylsEventPrice, 'Description' => $ylsDescription, 'Quantity' => $numYls, 'itemtype_id' => 3, 'visible' => $event->yls];
            $leaderStandard = ['invoice_id' => $invID, 'Value' => $leadersEventPrice, 'Description' => $leadersDescription, 'Quantity' => $numLeaders, 'itemtype_id' => 4, 'visible' => $event->leaders];

            $cubItem = $this->InvoiceItems->patchEntity($cubItem, $cubStandard);
            $yLItem = $this->InvoiceItems->patchEntity($yLItem, $ylStandard);
            $leaderItem = $this->InvoiceItems->patchEntity($leaderItem, $leaderStandard);

            // Add Discount
            if (isset($discount) && $discount->active) {
                $disCubs = floor($numCubs / $discount->discount_number);
                $discountValue = $discount->discount_value;
                $discountDescription = 'Discount: ' . $discount->text;
                $disVis = 1;
            } else {
                $discountValue = 0;
                $discountDescription = 'No Discount Available';
                $disVis = 0;
                $disCubs = 0;
            }

            $disStandard = ['invoice_id' => $invID, 'Value' => $discountValue, 'Description' => $discountDescription, 'Quantity' => $disCubs, 'itemtype_id' => 5, 'visible' => $disVis];

            $disItem = $this->InvoiceItems->newEntity($disStandard);

            // Event Max Cub Count

            $invItemCount = $invoices->find('all')
                ->contain(['Applications'])
                ->where(['Applications.event_id' => $event->id])
                ->count('*');

            if ($invItemCount > 0) {

                $invItems = $this->InvoiceItems->find('all');

                $invItemCounts = $invItems
                    ->select(['sum' => $invItems->func()->sum('Quantity')])
                    ->contain(['Invoices.Applications'])
                    ->where(['Applications.event_id' => $event->id])
                    ->group('itemtype_id')->toArray();

                $invCubs = $invItemCounts[1]->sum;
                $invYls = $invItemCounts[2]->sum;
                $invLeaders = $invItemCounts[3]->sum;
                
            } else {
                $invCubs = 0;
                $invYls = 0;
                $invLeaders = 0;
            }

            $totalEventCubs = $invCubs + $numCubs;            

            // Compare & Allow Save

            if (isset($event->available_cubs) && $event->available_cubs > 0 && $totalEventCubs >= $event->available_cubs) {
                $this->Flash->error(__('The Maximum Number of Cubs for this event is reached. The event is full.'));
            } else {
                if ($this->InvoiceItems->save($depCubItem) && $this->InvoiceItems->save($cubItem) && $this->InvoiceItems->save($yLItem) && $this->InvoiceItems->save($leaderItem) && $this->InvoiceItems->save($disItem)) {
                    $this->Flash->success(__('The invoice has been populated.'));
                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
                } else {
                    $this->Flash->error(__('There was an error.'));
                }
            }            
        }

        $this->set(compact('invoiceItem', 'invoices'));
        $this->set('_serialize', ['invoiceItem']);
        $this->set('invPop', $invPop);
        
        if ($this->request->is('get')) {

            // Values from the User Model e.g.
            $this->request->data['cubs'] = $predictedCubs;
            $this->request->data['yls'] = $predictedYls;
            $this->request->data['leaders'] = $predictedLeaders;

        }
    }

    public function repopulate($invID = null)
    {
        // Find Existing Lines
        $existingCubDep = $this->InvoiceItems->find()->where(['itemtype_id' => 1, 'invoice_id' => $invID])->first();
        $existingCub = $this->InvoiceItems->find()->where(['itemtype_id' => 2, 'invoice_id' => $invID])->first();
        $existingYl = $this->InvoiceItems->find()->where(['itemtype_id' => 3, 'invoice_id' => $invID])->first();
        $existingLeader = $this->InvoiceItems->find()->where(['itemtype_id' => 4, 'invoice_id' => $invID])->first();
        $existingDiscount = $this->InvoiceItems->find()->where(['itemtype_id' => 5, 'invoice_id' => $invID])->first();


        // Retrive IDs
        $existingCubDepID = $existingCubDep->id;
        $existingCubID = $existingCub->id;
        $existingYlID = $existingYl->id;
        $existingLeaderID = $existingLeader->id;
        $existingDiscountID = $existingDiscount->id;


        // Get Existing Lines
        $existingCubDepItem = $this->InvoiceItems->get($existingCubDepID);
        $existingCubItem = $this->InvoiceItems->get($existingCubID);
        $existingYlItem = $this->InvoiceItems->get($existingYlID);
        $existingLeaderItem = $this->InvoiceItems->get($existingLeaderID);
        $existingDiscountItem = $this->InvoiceItems->get($existingDiscountID);


        // Retrive Quantity Values
        $existingCubDepQty = $existingCubDepItem->Quantity;
        $existingCubQty = $existingCubItem->Quantity;
        $existingYlQty = $existingYlItem->Quantity;
        $existingLeaderQty = $existingLeaderItem->Quantity;
        $existingDiscountQty = $existingDiscountItem->Quantity;

        // Set Variable for the Modeless Form to take Values
        $invPop = new InvForm();
        $limitTextCubs = 'There is a limit for Cubs on this event.';
        $limitTextYls = 'There is a limit for Young Leaders on this event.';
        $limitTextLeaders = 'There is a limit for Leaders on this event.';

        // Connect Registry
        $settings = TableRegistry::get('Settings');
        $events = TableRegistry::get('Events');
        $applications = TableRegistry::get('Applications');
        $attendees = TableRegistry::get('Attendees');
        $invoices = TableRegistry::get('Invoices');
        $discounts = TableRegistry::get('Discounts');

        // Insantiate Objects
        $invoice = $invoices->get($invID, [
            'contain' => ['Users', 'Payments', 'InvoiceItems', 'Applications']
        ]);

        $application = $applications->get($invoice->application_id, [
            'contain' => ['Attendees']
        ]);

        $event = $events->get($application->event_id, ['contain' => ['Applications', 'Settings']]);

        $errorMsg = 'This event has been LOCKED to prevent updates to invoices. Please contact ' . $event->admin_full_name . '.';

        if ($event->invoices_locked) {
            $this->Flash->error(__($errorMsg));
            return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
        }

        if (isset($event->discount_id)) {
            $discount = $discounts->get($event->discount_id);
        }

        // Set Values for Options
        $CubsVis = $event->cubs;
        $YlsVis = $event->yls;
        $LeadersVis = $event->leaders;

        $this->set(compact('CubsVis', 'YlsVis', 'LeadersVis'));
        

        // Set Item Description Text
        $depositDescription = $event->deposit_text;
        $cubsDescription = $event->cubs_text;
        $ylsDescription = $event->yls_text;
        $leadersDescription = $event->leaders_text;

        // Set Item Price
        $depositEventPrice = $event->deposit_value;
        $cubsEventPrice = $event->cubs_value;
        $ylsEventPrice = $event->yls_value;
        $leadersEventPrice = $event->leaders_value;

        // Set Application ID
        $appID = $invoice->application_id;

        // Set Attendee Counts
        $attendeeCubCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $appID, 't.deleted IS' => NULL]);

        $attendeeYlCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $appID, 't.deleted IS' => NULL]);

        $attendeeLeaderCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.id' => $appID, 't.deleted IS' => NULL]);

        // Load into Variables
        $predictedAttCubs = $attendeeCubCount->count(['t.id']);
        $predictedAttYls = $attendeeYlCount->count(['t.id']);
        $predictedAttLeaders = $attendeeLeaderCount->count(['t.id']);

        // Perform the Post

        if ($this->request->is('post')) {

            // Extract Form Info
            if ($event->cubs) {
                $formNumCubs = $this->request->data['cubs'];
            } else {
                $formNumCubs = 0;
            }
            
            if ($event->yls) {
                $formNumYls = $this->request->data['yls'];
            } else {
                $formNumYls = 0;
            }

            if ($event->leaders) {
                $formNumLeaders = $this->request->data['leaders'];
            } else {
                $formNumLeaders = 0;
            }
            


            // Compare Form Info - Cubs
            if ($event->max && $formNumCubs >= $event->max_cubs) {
                $numCubs = $event->max_cubs;
                $this->Flash->error(__($limitTextCubs));
            } elseif (!$event->allow_reductions && $event->cubs && $formNumCubs < $existingCubQty) {
                $numCubs = $existingCubQty;
                $this->Flash->error(__('You cannot reduce the number of Cubs.'));
            } elseif (!$event->cubs) {
                $numCubs = $existingCubQty;
            } else {
                $numCubs = $formNumCubs;
            }


            // Compare Form Info - YLs
            if ($event->max && $formNumYls >= $event->max_yls) {
                $numYls = $event->max_yls;
                $this->Flash->error(__($limitTextYls));
            } elseif (!$event->allow_reductions && $event->yls && $formNumYls < $existingYlQty) {
                $numYls = $existingYlQty;
                $this->Flash->error(__('You cannot reduce the number of Young Leaders.'));
            } elseif (!$event->yls) {
                $numYls = $existingYlQty;
            } else {
                $numYls = $formNumYls;
            }


            // Compare Form Info - Leaders
            if ($event->max && $formNumLeaders >= $event->max_leaders) {
                $numLeaders = $event->max_leaders;
                $this->Flash->error(__($limitTextLeaders));
            } elseif (!$event->allow_reductions && $event->leaders && $formNumLeaders < $existingLeaderQty) {
                $numLeaders = $existingLeaderQty;
                $this->Flash->error(__('You cannot reduce the number of Leaders.'));
            } elseif (!$event->leaders) {
                $numLeaders = $existingLeaderQty;
            } else {
                $numLeaders = $formNumLeaders;
            }

            // Patch Items with Deposit Invoices
            if ($event->deposit) {
                $depValue = $event->deposit_value;
                $depDescription = $event->deposit_text;
                if ($event->deposit_inc_leaders) {
                    $depNum = $numCubs + $numLeaders + $numYls;
                } else {
                    $depNum = $numCubs;
                }
            } else {
                $depValue = 0;
                $depDescription = 'No Deposit Required';
                $depNum = 0;
            }

            $cubDeposit = ['invoice_id' => $invID, 'Value' => $depValue, 'Description' => $depDescription, 'Quantity' => $depNum, 'itemtype_id' => 1, 'visible' => $event->deposit];
            $depCubItem = $this->InvoiceItems->patchEntity($existingCubDepItem, $cubDeposit);

            // Patch Items with Standard Info

            if (!$event->cubs && $numCubs > 0) {
                $cubVisiblity = true;
            } else {
                $cubVisiblity = $event->cubs;
            }

            if (!$event->yls && $numYls > 0) {
                $ylVisiblity = true;
            } else {
                $ylVisiblity = $event->yls;
            }

            if (!$event->leaders && $numLeaders > 0) {
                $leaderVisiblity = true;
            } else {
                $leaderVisiblity = $event->leaders;
            }

            $cubStandard = ['invoice_id' => $invID, 'Value' => $cubsEventPrice, 'Description' => $cubsDescription, 'Quantity' => $numCubs, 'itemtype_id' => 2, 'visible' => $cubVisiblity];
            $ylStandard = ['invoice_id' => $invID, 'Value' => $ylsEventPrice, 'Description' => $ylsDescription, 'Quantity' => $numYls, 'itemtype_id' => 3, 'visible' => $ylVisiblity];
            $leaderStandard = ['invoice_id' => $invID, 'Value' => $leadersEventPrice, 'Description' => $leadersDescription, 'Quantity' => $numLeaders, 'itemtype_id' => 4, 'visible' => $leaderVisiblity];

            $existingCubItem = $this->InvoiceItems->patchEntity($existingCubItem, $cubStandard);
            $existingYlItem = $this->InvoiceItems->patchEntity($existingYlItem, $ylStandard);
            $existingLeaderItem = $this->InvoiceItems->patchEntity($existingLeaderItem, $leaderStandard);

            // Add Discount
            if (isset($discount) && $discount->active) {
                $disCubs = floor($numCubs / $discount->discount_number);
                $discountValue = $discount->discount_value;
                $discountDescription = 'Discount: ' . $discount->text;
                $disVis = 1;
            } else {
                $discountValue = 0;
                $discountDescription = 'No Discount Available';
                $disVis = 0;
                $disCubs = 0;
            }

            $disStandard = ['invoice_id' => $invID, 'Value' => $discountValue, 'Description' => $discountDescription, 'Quantity' => $disCubs, 'itemtype_id' => 5, 'visible' => $disVis];

            $disItem = $this->InvoiceItems->newEntity($disStandard);

            // Event Max Cub Count

            $invItemCount = $invoices->find('all')
                ->contain(['Applications'])
                ->where(['Applications.event_id' => $event->id])
                ->count('*');

            if ($invItemCount > 0) {

                $invItems = $this->InvoiceItems->find('all');

                $invItemCounts = $invItems
                    ->select(['sum' => $invItems->func()->sum('Quantity')])
                    ->contain(['Invoices.Applications'])
                    ->where(['Applications.event_id' => $event->id])
                    ->group('itemtype_id')->toArray();

                $invCubs = $invItemCounts[1]->sum;
                $invYls = $invItemCounts[2]->sum;
                $invLeaders = $invItemCounts[3]->sum;
                
            } else {
                $invCubs = 0;
                $invYls = 0;
                $invLeaders = 0;
            }

            $totalEventCubs = ($invCubs - $existingCubQty) + $numCubs;

            // Compare & Allow Save

            if (isset($event->available_cubs) && $event->available_cubs > 0 && $totalEventCubs >= $event->available_cubs) {
                $this->Flash->error(__('The Maximum Number of Cubs for this event is reached. The event is full.'));
            } else {
                if ($this->InvoiceItems->save($existingCubDepItem) && $this->InvoiceItems->save($existingCubItem) && $this->InvoiceItems->save($existingYlItem) && $this->InvoiceItems->save($existingLeaderItem) && $this->InvoiceItems->save($disItem) && $this->InvoiceItems->delete($existingDiscountItem)) {
                    $this->Flash->success(__('The invoice has been repopulated with updated values.'));
                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
                } else {
                    $this->Flash->error(__('There was an error.'));
                }
            }            
        }

        $this->set(compact('invoiceItem', 'invoices'));
        $this->set('_serialize', ['invoiceItem']);
        $this->set('invPop', $invPop);

        // Set Field Loader Variables (for Get)
        if (ISSET($predictedAttCubs) && $predictedAttCubs > $existingCubQty) {
            if ($event->max && $predictedAttCubs >= $event->max_cubs) {
                $predictedCubs = $event->max_cubs;
                $this->Flash->error(__($limitTextCubs));
            } else {
                $predictedCubs = $predictedAttCubs;
            }
        } elseif ($event->max && $predictedAttCubs >= $event->max_cubs) {
            $predictedCubs = $event->max_cubs;
            $this->Flash->error(__($limitTextCubs));
        } else {
            $predictedCubs = $existingCubQty;
        }

        if (ISSET($predictedAttYls) && $predictedAttYls > $existingYlQty) {
            if ($event->max && $predictedAttYls >= $event->max_yls) {
                $predictedYls = $event->max_yls;
                $this->Flash->error(__($limitTextYls));
            } else {
                $predictedYls = $predictedAttYls;
            }
        } elseif ($event->max && $predictedAttYls >= $event->max_yls) {
            $predictedYls = $event->max_yls;
            $this->Flash->error(__($limitTextYls));
        } else {
            $predictedYls = $existingYlQty;
        }

        if (ISSET($predictedAttLeaders) && $predictedAttLeaders > $existingLeaderQty) {
            if ($event->max && $predictedAttLeaders >= $event->max_leaders) {
                $predictedLeaders = $event->max_leaders;
                $this->Flash->error(__($limitTextLeaders));
            } else {
                $predictedLeaders = $predictedAttLeaders;
            }
        } elseif ($event->max && $predictedAttLeaders >= $event->max_leaders) {
            $predictedLeaders = $event->max_leaders;
            $this->Flash->error(__($limitTextLeaders));
        } else {
            $predictedLeaders = $existingLeaderQty;
        }

        if ($this->request->is('get')) {
            // Values from the User Model e.g.
            $this->request->data['cubs'] = $predictedCubs;
            $this->request->data['yls'] = $predictedYls;
            $this->request->data['leaders'] = $predictedLeaders;
        }
        
    }
}
