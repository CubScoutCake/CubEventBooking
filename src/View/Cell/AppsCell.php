<?php
namespace App\View\Cell;

use Cake\ORM\TableRegistry;
use Cake\View\Cell;

/**
 * Notifications cell
 */
class AppsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @param int $userId The User id of the Notifications.
     *
     * @return void
     */
    public function display($userId = null)
    {
        $invs = TableRegistry::get('Invoices');
        $atts = TableRegistry::get('Attendees');
        $itms = TableRegistry::get('InvoiceItems');
        $apps = TableRegistry::get('Applications');

        if (isset($userId)) {
            $taskArr = $apps->find('all')->where(['user_id' => $userId]);

            foreach ($taskArr as $app) {
                $tasks = [];
                array_push($tasks, [13 => ['done' => 1]], [14 => ['done' => 2]], [15 => ['done' => 3]]);
                $app->done = 1;
                $app->status = 'success';
            }

            $this->set(compact('tasks'));

            /*$application = $apps->get($app->id, [
                'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['conditions' => ['user_id' => $this->Auth->user('id')]]]
            ]);

            $this->set('application', $application);
            $this->set('_serialize', ['application']);

            $invoices = $invs->find('all')->where(['application_id' => $id]);
            $invCount = $invoices->count('*');
            $this->set(compact('invCount'));

            $attendeeCubCount = $this->Applications->find()
                ->enableHydration(false)
                ->join([
                    'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                    't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                    'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
                ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $id]);

            $attendeeYlCount = $this->Applications->find()
                ->enableHydration(false)
                ->join([
                    'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                    't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                    'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
                ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $id]);

            $attendeeLeaderCount = $this->Applications->find()
                ->enableHydration(false)
                ->join([
                    'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                    't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                    'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
                ])->where(['r.minor' => 0, 'Applications.id' => $id]);

            $attCubs = $attendeeCubCount->count(['t.id']);
            $attYls = $attendeeYlCount->count(['t.id']);
            $attLeaders = $attendeeLeaderCount->count(['t.id']);

            $attNotCubs = $attYls + $attLeaders;
            $this->set(compact('attCubs','attYls','attLeaders','attNotCubs'));

            $invItemCounts = $itms->find('all')
                ->contain(['Invoices.Applications'])
                ->where(['Applications.id' => $id])
                ->select(['sum' => $invoices->func()->sum('Quantity')])
                ->group('itemtype_id')->toArray();

            $invCubs = $invItemCounts[1]->sum;
            $invYls = $invItemCounts[2]->sum;
            $invLeaders = $invItemCounts[3]->sum;

            $invNotCubs = $invYls + $invLeaders;
            $this->set(compact('invCubs','invYls','invLeaders','invNotCubs'));

            $sumValueItem = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->first();
            $sumPaymentItem = $invoices->select(['sum' => $invoices->func()->sum('value')])->first();

            $sumValues = $sumValueItem->sum;
            $sumPayments = $sumPaymentItem->sum;

            $sumBalances = $sumValues - $sumPayments;

            $appDone = 1; // Set at 100% because an application has been created.

            if ($invCount > 1) {
                $this->Flash->error(__('There are Multiple Invoices on one Application.'));
            } elseif ($invCount == 1) {
                $invDone = 1;
            } else {
                $invDone = 0;
            }

            if ($attCubs > 0 && $invCubs > 0 && $invCubs >= $attCubs)  {
                $addCubs = $invCubs - $attCubs;
                $cubsDone = $attCubs / $invCubs;

                $this->set(compact('addCubs'));

            } elseif ($attCubs > 0 && $invCubs < $attCubs) {
                $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Attendees.'));
                $invDone = 0.5;
                $cubsDone = 1;
            } else {
                $cubsDone = 0;
            }

            if ($attNotCubs > 0 && $invNotCubs > 0 && $invNotCubs >= $attNotCubs)  {
                $addNotCubs = $invNotCubs - $attNotCubs;
                $cubsNotDone = $attNotCubs / $invNotCubs;

            } elseif ($attNotCubs > 0 && $invNotCubs < $attNotCubs) {
                $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Attendees.'));
                $invDone = 0.5;
                $cubsNotDone = 1;
            } else {
                $cubsNotDone = 0;
            }

            if ($sumPayments > 0 && $sumBalances == 0) {
                $payDone = 1;
            } elseif ($sumValues > 0) {
                $payDone = $sumPayments / $sumValues;
            }

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

            $this->set(compact('appsDone','appsStatus'));*/
        }

        //$this->set('notifications', $this->paginate($this->Notifications));
        $this->set('_serialize', ['tasks']);
    }
}
