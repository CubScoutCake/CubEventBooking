<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class ProgressComponent extends Component
{
    public $components = ['Flash'];

    public function determineApp($appID, $admin, $userID, $set)
    {
		$apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $atts = TableRegistry::get('Attendees');
        $itms = TableRegistry::get('InvoiceItems');

        $controller = $this->_registry->getController();

        // Get Application
		$app = $apps->get($appID, [
            'contain' => [
                'Users',
                'Scoutgroups',
                'Events',
                'Invoices',
                'Attendees' => [
                    'sort' => [
                        'Attendees.role_id' => 'ASC', 
                        'Attendees.lastname' => 'ASC'
                    ]
                ], 
                'Attendees.Roles' => [
                    'conditions' => [
                        'Attendees.user_id' => $userID
                ]], 
                'Attendees.Scoutgroups' => [
                    'conditions' => [
                        'Attendees.user_id' => $userID
                ]]]
        ]);

        // Determine Invoice Progress
        $invoices = $invs->find('all')->where(['application_id' => $appID]);
        $invCount = $invoices->count('*');
        $invFirst = $invs->find('all')->where(['application_id' => $appID])->first();
        $controller->set(compact('invCount', 'invFirst'));


        // Find Cub, YL & Leader Counts
        $attendeeCubCount = $apps->find('cubs')->where(['Applications.id' => $appID])->all();
        $attendeeYlCount = $apps->find('youngLeaders')->where(['Applications.id' => $appID])->all();
        $attendeeLeaderCount = $apps->find('leaders')->where(['Applications.id' => $appID])->all();

        $attCubs = $attendeeCubCount->count(['t.id']);
        $attYls = $attendeeYlCount->count(['t.id']);
        $attLeaders = $attendeeLeaderCount->count(['t.id']);

        $attNotCubs = $attYls + $attLeaders;
        $controller->set(compact('attCubs', 'attYls', 'attLeaders', 'attNotCubs'));

        if ($invCount > 0) {
            $invItemCount = $itms->find('all')
                ->contain(['Invoices.Applications'])
                ->where(['Applications.id' => $appID])
                ->count('*');

            if ($invItemCount > 0) {
                $invItemCounts = $itms->find('all')
                    ->contain(['Invoices.Applications'])
                    ->where(['Applications.id' => $appID])
                    ->select(['sum' => $invoices->func()->sum('Quantity')])
                    ->group('itemtype_id')->toArray();

                $invCubs = $invItemCounts[1]->sum;
                $invYls = $invItemCounts[2]->sum;
                $invLeaders = $invItemCounts[3]->sum;
            } else {
                $invCubs = 0;
                $invYls = 0;
                $invLeaders = 0;
            }
        } else {
            $invCubs = 0;
            $invYls = 0;
            $invLeaders = 0;
        }

        $invNotCubs = $invYls + $invLeaders;
        $controller->set(compact('invCubs', 'invYls', 'invLeaders', 'invNotCubs'));

        if ($invCount > 0) {
            $sumValueItem = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->first();
            $sumPaymentItem = $invoices->select(['sum' => $invoices->func()->sum('value')])->first();

            $sumValues = $sumValueItem->sum;
            $sumPayments = $sumPaymentItem->sum;
        } else {
            $sumValues = 0;
            $sumPayments = 0;
        }

        $sumBalances = $sumValues - $sumPayments;
        $controller->set(compact('sumBalances', 'sumPayments', 'sumValues'));

        $appDone = 1; // Set at 100% because an application has been created.

        if ($invCount > 1) {
            $this->Flash->error(__('There are Multiple Invoices on one Application.'));
            $invDone = 0.5;
        } elseif ($invCount == 1) {
            $invDone = 1;
        } else {
            $invDone = 0;
        }

        if ($attCubs > 0 && $invCubs > 0 && $invCubs >= $attCubs) {
            $addCubs = $invCubs - $attCubs;
            $cubsDone = $attCubs / $invCubs;

            $controller->set(compact('addCubs'));
        } elseif ($attCubs > 0 && $invCubs < $attCubs) {
            $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Cubs.'));
            if ($invCount > 1) {
                $invDone = 0.5;
            } elseif ($invCount == 1) {
                $invDone = 0.5;
            } else {
                $invDone = 0;
            }
            $cubsDone = 1;
        } else {
            $cubsDone = 0;
        }

        if ($attNotCubs > 0 && $invNotCubs > 0 && $invNotCubs >= $attNotCubs) {
            $addNotCubs = $invNotCubs - $attNotCubs;
            $cubsNotDone = $attNotCubs / $invNotCubs;

            $controller->set(compact('addNotCubs'));
        } elseif ($attNotCubs > 0 && $invNotCubs < $attNotCubs) {
            $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Leaders & Young Leaders.'));
            if ($invCount > 1) {
                $invDone = 0.5;
            } elseif ($invCount == 1) {
                $invDone = 0.5;
            } else {
                $invDone = 0;
            }
            $cubsNotDone = 1;
        } else {
            $cubsNotDone = 0;
        }

        if ($sumPayments > 0 && $sumBalances == 0) {
            $payDone = 1;
        } elseif ($sumValues > 0) {
            $payDone = $sumPayments / $sumValues;
        } else {
            $payDone = 0;
        }
        
        $controller->set(compact('appDone', 'invDone', 'cubsDone', 'cubsNotDone', 'payDone'));

        $done = ($appDone + $invDone + $cubsDone + $cubsNotDone + $payDone) / 5;

        if ($done >= 1) {
            $status = 'success';
        } elseif ($cubsDone >= 1 && $cubsNotDone >= 1) {
            $status = 'info';
        } elseif ($appDone >= 1 && $invDone >= 1) {
            $status = 'warning';
        } else {
            $status = 'danger';
        }

        $controller->set(compact('done', 'status'));

        $results = [];

        return $results;
    }
}