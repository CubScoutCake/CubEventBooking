<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 10/01/2017
 * Time: 21:09
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class InvoiceComponent extends Component
{
    public $components = ['Flash'];

    public function populateInvoice($invoiceId, $Cubs = null, $Yls = null, $Leaders = null)
    {
        $this->Invoices = TableRegistry::get('Invoices');
        $this->Events = TableRegistry::get('Events');
        $this->Discounts = TableRegistry::get('Discounts');

        $invoice = $this->Invoices->get($invoiceId, [
            'contain' => ['Users', 'Payments', 'InvoiceItems', 'Applications']
        ]);
        $event = $this->Events->get($application['event_id']);

        $this->getLines($invoiceId);

        if (isset($event->discount_id)) {
            $discount = $discounts->get($event->discount_id);
        }

        // Set Form Info
        if ($event->cubs) {
            $formNumCubs = $Cubs;
        } else {
            $formNumCubs = 0;
        }

        if ($event->yls) {
            $formNumYls = $Yls;
        } else {
            $formNumYls = 0;
        }

        if ($event->leaders) {
            $formNumLeaders = $Leaders;
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

    public function getLines($invoiceId)
    {
        $this->InvoiceItems = TableRegistry::get('InvoiceItems');

        // Find Existing Lines
        $existingCubDep = $this->InvoiceItems->find()->where(['itemtype_id' => 1, 'invoice_id' => $invoiceId])->first();
        $existingCub = $this->InvoiceItems->find()->where(['itemtype_id' => 2, 'invoice_id' => $invoiceId])->first();
        $existingYl = $this->InvoiceItems->find()->where(['itemtype_id' => 3, 'invoice_id' => $invoiceId])->first();
        $existingLeader = $this->InvoiceItems->find()->where(['itemtype_id' => 4, 'invoice_id' => $invoiceId])->first();
        $existingDiscount = $this->InvoiceItems->find()->where(['itemtype_id' => 5, 'invoice_id' => $invoiceId])->first();


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
    }
}
