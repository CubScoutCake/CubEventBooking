<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use App\Form\InvcanForm;
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
    /*public function add()
    {
        $invoiceItem = $this->InvoiceItems->newEntity();
        if ($this->request->is('post')) {
            $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->data);
            if ($this->InvoiceItems->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
            }
        }
        $invoices = $this->InvoiceItems->Invoices->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $this->set(compact('invoiceItem', 'invoices'));
        $this->set('_serialize', ['invoiceItem']);
    }*/

    /**
     * Edit method
     *
     * @param string|null $id Invoice Item id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceItem = $this->InvoiceItems->get($id);

        $invNum = $invoiceItem->invoice_id;

        $permitted = [7, 8, 9, 10];
        if (!in_array($invoiceItem->itemtype_id, $permitted)) {
            $this->Flash->error(__('You can only edit cancelled values.'));

            return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invNum]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceItem = $this->InvoiceItems->patchEntity($invoiceItem, $this->request->data);
            if ($this->InvoiceItems->save($invoiceItem)) {
                $this->Flash->success(__('The invoice item has been saved.'));

                return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invNum]);
            } else {
                $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('invoiceItem'));
        $this->set('_serialize', ['invoiceItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Item id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    /*public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceItem = $this->InvoiceItems->get($id);
        if ($this->InvoiceItems->delete($invoiceItem)) {
            $this->Flash->success(__('The invoice item has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }*/

    public function overdue($invID = null, $percentage = 10)
    {
        if (isset($invID)) {
            $invs = TableRegistry::get('Invoices');
            $invoice = $invs->get($invID);

            $feePercent = $percentage / 100;

            $totalBalance = $invoice->initialvalue - $invoice->value;
            $fee = $totalBalance * $feePercent;

            $feeItem = $this->InvoiceItems->newEntity();

            $feeData = [
                'invoice_id' => $invID,
                'Quantity' => 1,
                'Value' => $fee,
                'Description' => 'Late Payment Surcharge - 10% of Balance',
                'itemtype_id' => 11,
                'visible' => 1
            ];

            $feeItem = $this->InvoiceItems->patchEntity($feeItem, $feeData);

            if ($this->InvoiceItems->save($feeItem)) {
                $this->Flash->success('An Overdue Surcharge was added to the invoice.');

                return $this->redirect(['controller' => 'Notifications', 'action' => 'surcharge', $invID, $percentage]);
            } else {
                $this->Flash->error('There was an error in adding a Surcharge.');

                return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
            }
        } else {
            $this->Flash->error('The Invoice ID was not set.');

            return $this->redirect(['controller' => 'Invoices', 'action' => 'outstanding']);
        }
    }

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
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $appID, 't.deleted IS' => null]);

        $attendeeYlCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $appID, 't.deleted IS' => null]);

        $attendeeLeaderCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.id' => $appID, 't.deleted IS' => null]);

        // Load into Variables
        $predictedCubs = $attendeeCubCount->count(['t.id']);
        $predictedYls = $attendeeYlCount->count(['t.id']);
        $predictedLeaders = $attendeeLeaderCount->count(['t.id']);

        // Set Variable for the Modeless Form to take Values

        $invPop = new InvForm();

        // Create Entities
        $cubItem = $this->InvoiceItems->newEntity();
        $depCubItem = $this->InvoiceItems->newEntity();

        $yLItem = $this->InvoiceItems->newEntity();
        // $depYLItem = $this->InvoiceItems->newEntity();

        $leaderItem = $this->InvoiceItems->newEntity();
        // $depLeaderItem = $this->InvoiceItems->newEntity();

        if ($this->request->is('post')) {
            // Extract Form Info
            $numCubs = $this->request->data['cubs'];
            $numYls = $this->request->data['yls'];
            $numLeaders = $this->request->data['leaders'];

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

            if ($this->InvoiceItems->save($depCubItem)
                && $this->InvoiceItems->save($cubItem)
                && $this->InvoiceItems->save($yLItem)
                && $this->InvoiceItems->save($leaderItem)
                && $this->InvoiceItems->save($disItem)) {
                $this->Flash->success(__('The invoice has been populated.'));

                return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
            } else {
                $this->Flash->error(__('There was an error.'));
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

            // Set Values for Options
            $CubsVis = $event->cubs;
            $YlsVis = $event->yls;
            $LeadersVis = $event->leaders;

            $this->set(compact('CubsVis', 'YlsVis', 'LeadersVis'));
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

        // Retrive Cancelled Quantities

        // Find Existing Cancelled Lines
        $existingCanCubDep = $this->InvoiceItems->find()->where(['itemtype_id' => 7, 'invoice_id' => $invID])->first();
        $existingCanCub = $this->InvoiceItems->find()->where(['itemtype_id' => 8, 'invoice_id' => $invID])->first();
        $existingCanYl = $this->InvoiceItems->find()->where(['itemtype_id' => 9, 'invoice_id' => $invID])->first();
        $existingCanLeader = $this->InvoiceItems->find()->where(['itemtype_id' => 10, 'invoice_id' => $invID])->first();

        // Retrive Cancelled Deposit
        if (!empty($existingCanCubDep)) {
            $existingCanCubDepID = $existingCanCubDep->id;
            $existingCanCubDepItem = $this->InvoiceItems->get($existingCanCubDepID);
            $existingCanCubDepQty = $existingCanCubDepItem->Quantity;
        } else {
            $existingCanCubDepQty = 0;
            $existingCanCubDepItem = $this->InvoiceItems->newEntity();
        }

        if (!empty($existingCanCub)) {
            $existingCanCubID = $existingCanCub->id;
            $existingCanCubItem = $this->InvoiceItems->get($existingCanCubID);
            $existingCanCubQty = $existingCanCubItem->Quantity;
        } else {
            $existingCanCubQty = 0;
            $existingCanCubItem = $this->InvoiceItems->newEntity();
        }

        if (!empty($existingCanYl)) {
            $existingCanYlID = $existingCanYl->id;
            $existingCanYlItem = $this->InvoiceItems->get($existingCanYlID);
            $existingCanYlQty = $existingCanYlItem->Quantity;
        } else {
            $existingCanYlQty = 0;
            $existingCanYlItem = $this->InvoiceItems->newEntity();
        }

        if (!empty($existingCanLeader)) {
            $existingCanLeaderID = $existingCanLeader->id;
            $existingCanLeaderItem = $this->InvoiceItems->get($existingCanLeaderID);
            $existingCanLeaderQty = $existingCanLeaderItem->Quantity;
        } else {
            $existingCanLeaderQty = 0;
            $existingCanLeaderItem = $this->InvoiceItems->newEntity();
        }

        $totalExistingCancelled = $existingCanCubQty + $existingCanYlQty + $existingCanLeaderQty + $existingCanCubDepQty;

        // Set Variable for the Modeless Form to take Values
        $invPop = new InvcanForm();
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
        if (isset($event->discount_id)) {
            $discount = $discounts->get($event->discount_id);
        }


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

        // Set Cancelled Item Description Text
        $depositCanDescription = 'CANCELLED: ' . $event->deposit_text;
        $cubsCanDescription = 'CANCELLED: ' . $event->cubs_text;
        $ylsCanDescription = 'CANCELLED: ' . $event->yls_text;
        $leadersCanDescription = 'CANCELLED: ' . $event->leaders_text;

        // Set Cancelled Item Price  // THIS WILL BE WHERE CANCELLATION RATIO WILL COME IN
        $depositCanEventPrice = $event->deposit_value;
        $cubsCanEventPrice = $event->cubs_value;
        $ylsCanEventPrice = $event->yls_value;
        $leadersCanEventPrice = $event->leaders_value;

        // Set Application ID
        $appID = $invoice->application_id;

        // Set Attendee Counts
        $attendeeCubCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $appID, 't.deleted IS' => null]);

        $attendeeYlCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $appID, 't.deleted IS' => null]);

        $attendeeLeaderCount = $applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.id' => $appID, 't.deleted IS' => null]);

        // Load into Variables
        $predictedAttCubs = $attendeeCubCount->count(['t.id']);
        $predictedAttYls = $attendeeYlCount->count(['t.id']);
        $predictedAttLeaders = $attendeeLeaderCount->count(['t.id']);

        // Perform the Post

        if ($this->request->is('post')) {
            $numCubs = $this->request->data['cubs'];
            $numYls = $this->request->data['yls'];
            $numLeaders = $this->request->data['leaders'];

            $totalAtts = $numCubs + $numLeaders + $numYls;

            // Patch Items with Deposit Invoices
            if ($event->deposit) {
                $depValue = $event->deposit_value;
                $depDescription = $depositDescription;
                if ($event->deposit_inc_leaders) {
                    $depNum = $totalAtts;
                } else {
                    $depNum = $numCubs;
                }
            } else {
                $depValue = 0;
                $depDescription = 'No Deposit Required';
                $depNum = 0;
            }

            // Add Discount
            if (isset($discount) && $discount->active) {
                $disCubs = floor($numCubs / $discount->discount_number);
                $discountValue = $discount->discount_value;
                $discountDescription = 'Discount: ' . $discount->text;
            } else {
                $discountValue = 0;
                $discountDescription = 'No Discount Available';
                $disCubs = 0;
            }

            // Set Visiblity for Display

            if ($depNum > 0) {
                $DepVis = 1;
            } else {
                $DepVis = $event->deposit;
            }

            if ($numCubs > 0) {
                $CubsVis = 1;
            } else {
                $CubsVis = $event->cubs;
            }

            if ($numYls > 0) {
                $YlsVis = 1;
            } else {
                $YlsVis = $event->yls;
            }

            if ($numLeaders > 0) {
                $LeadersVis = 1;
            } else {
                $LeadersVis = $event->leaders;
            }

            if ($disCubs > 0) {
                $DisVis = 1;
            } elseif (isset($discount) && $discount->active) {
                $DisVis = 1;
            } else {
                $DisVis = 0;
            }

            // Patch Items with Standard Info
            $cubDeposit = ['invoice_id' => $invID
                , 'Value' => $depValue
                , 'Description' => $depDescription
                , 'Quantity' => $depNum
                , 'itemtype_id' => 1
                , 'visible' => $DepVis];

            $cubStandard = ['invoice_id' => $invID
                , 'Value' => $cubsEventPrice
                , 'Description' => $cubsDescription
                , 'Quantity' => $numCubs
                , 'itemtype_id' => 2
                , 'visible' => $CubsVis];

            $ylStandard = ['invoice_id' => $invID
                , 'Value' => $ylsEventPrice
                , 'Description' => $ylsDescription
                , 'Quantity' => $numYls
                , 'itemtype_id' => 3
                , 'visible' => $YlsVis];

            $leaderStandard = ['invoice_id' => $invID
                , 'Value' => $leadersEventPrice
                , 'Description' => $leadersDescription
                , 'Quantity' => $numLeaders
                , 'itemtype_id' => 4
                , 'visible' => $LeadersVis];

            $disStandard = ['invoice_id' => $invID
                , 'Value' => $discountValue
                , 'Description' => $discountDescription
                , 'Quantity' => $disCubs
                , 'itemtype_id' => 5
                , 'visible' => $DisVis];

            $existingCubDepItem = $this->InvoiceItems->patchEntity($existingCubDepItem, $cubDeposit);
            $existingCubItem = $this->InvoiceItems->patchEntity($existingCubItem, $cubStandard);
            $existingYlItem = $this->InvoiceItems->patchEntity($existingYlItem, $ylStandard);
            $existingLeaderItem = $this->InvoiceItems->patchEntity($existingLeaderItem, $leaderStandard);
            $existingDiscountItem = $this->InvoiceItems->patchEntity($existingDiscountItem, $disStandard);

            // REPEAT FOR CANCELLED

            $numCanCubs = $this->request->data['cancelled_cubs'];
            $numCanYls = $this->request->data['cancelled_yls'];
            $numCanLeaders = $this->request->data['cancelled_leaders'];

            $totalCancelled = $numCanCubs + $numCanLeaders + $numCanYls;
            $cancelledEver = MAX($totalCancelled, $totalExistingCancelled);

            // SET CANCELLED VISIBLITY
            if (MAX($existingCanCubDepQty, $cancelledEver) > 0) {
                $DepCanVis = 1;
            } else {
                $DepCanVis = 0;
            }

            if (MAX($existingCanCubQty, $numCanCubs) > 0) {
                $CubsCanVis = 1;
            } else {
                $CubsCanVis = 0;
            }

            if (MAX($existingCanYlQty, $numCanYls) > 0) {
                $YlsCanVis = 1;
            } else {
                $YlsCanVis = 0;
            }

            if (MAX($existingCanLeaderQty, $numCanLeaders) > 0) {
                $LeadersCanVis = 1;
            } else {
                $LeadersCanVis = 0;
            }

            // Patch Items with Deposit Invoices
            if ($event->deposit) {
                $depCanValue = $depositCanEventPrice;
                $depCanDescription = $depositCanDescription;
                if ($event->deposit_inc_leaders) {
                    $depCanNum = $totalCancelled;
                } else {
                    $depCanNum = $numCanCubs;
                }
            } else {
                $depCanValue = 0;
                $depCanDescription = 'No Deposit Required';
                $depCanNum = 0;
            }

            $depositCancelled = ['invoice_id' => $invID
                , 'Value' => $depCanValue
                , 'Description' => $depCanDescription
                , 'Quantity' => $depCanNum
                , 'itemtype_id' => 7
                , 'visible' => $DepCanVis];
            $existingCanCubDepItem = $this->InvoiceItems->patchEntity($existingCanCubDepItem, $depositCancelled);

            // Patch Items with Cancelled Info

            $cubCancelled = ['invoice_id' => $invID
                , 'Value' => $cubsCanEventPrice
                , 'Description' => $cubsCanDescription
                , 'Quantity' => $numCanCubs
                , 'itemtype_id' => 8
                , 'visible' => $CubsCanVis];
            $ylCancelled = ['invoice_id' => $invID
                , 'Value' => $ylsCanEventPrice
                , 'Description' => $ylsCanDescription
                , 'Quantity' => $numCanYls
                , 'itemtype_id' => 9
                , 'visible' => $YlsCanVis];
            $leaderCancelled = ['invoice_id' => $invID
                , 'Value' => $leadersCanEventPrice
                , 'Description' => $leadersCanDescription
                , 'Quantity' => $numCanLeaders
                , 'itemtype_id' => 10
                , 'visible' => $LeadersCanVis];

            $existingCanCubItem = $this->InvoiceItems->patchEntity($existingCanCubItem, $cubCancelled);
            $existingCanYlItem = $this->InvoiceItems->patchEntity($existingCanYlItem, $ylCancelled);
            $existingCanLeaderItem = $this->InvoiceItems->patchEntity($existingCanLeaderItem, $leaderCancelled);

            // SAVE THE ENTITIES AND COMPLETE

            if ($this->InvoiceItems->save($existingCubDepItem)
                    && $this->InvoiceItems->save($existingCubItem)
                    && $this->InvoiceItems->save($existingYlItem)
                    && $this->InvoiceItems->save($existingLeaderItem)
                    && $this->InvoiceItems->save($existingDiscountItem)) {
                if ($cancelledEver > 0) {
                    if ($this->InvoiceItems->save($existingCanCubDepItem)
                        && $this->InvoiceItems->save($existingCanCubItem)
                        && $this->InvoiceItems->save($existingCanYlItem)
                        && $this->InvoiceItems->save($existingCanLeaderItem)) {
                        // SUCCESS
                        $this->Flash->success(__('The invoice has been repopulated with updated values.'));

                        return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
                    } else {
                        $this->Flash->error(__('There was an error with Cancellation.'));
                    }
                } else {
                    // SUCCESS
                    $this->Flash->success(__('The invoice has been repopulated with updated values.'));

                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invID]);
                }
            } else {
                $this->Flash->error(__('There was an error.'));
            }
        }

        $this->set(compact('invoiceItem', 'invoices'));
        $this->set('_serialize', ['invoiceItem']);
        $this->set('invPop', $invPop);

        // Set Field Loader Variables (for Get)
        if (isset($predictedAttCubs) && $predictedAttCubs > $existingCubQty) {
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

        if (isset($predictedAttYls) && $predictedAttYls > $existingYlQty) {
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

        if (isset($predictedAttLeaders) && $predictedAttLeaders > $existingLeaderQty) {
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

            $this->request->data['cancelled_cubs'] = $existingCanCubQty;
            $this->request->data['cancelled_yls'] = $existingCanYlQty;
            $this->request->data['cancelled_leaders'] = $existingCanLeaderQty;

            $this->set(compact('CubsVis', 'YlsVis', 'LeadersVis'));
        }
    }
}
