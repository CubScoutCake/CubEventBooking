<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Class ProgressComponent
 *
 * @package App\Controller\Component
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @property \App\Model\Table\InvoicesTable $Invoices
 * @property \Cake\Controller\Controller $Controller
 *
 * @property \App\Controller\Component\AvailabilityComponent $Availability
 * @property \Cake\Controller\Component\FlashComponent $Flash
 */
class ProgressComponent extends Component
{
    public $components = ['Flash', 'Availability'];

    /**
     * A Function to Determine the Application
     *
     * @param int $appID The Application ID
     * @param bool $admin Is in Admin Scope (Reveal Others)
     * @param int $userID The ID of the Viewing User
     * @param bool $set Set Variables
     * @param bool $full Full Output
     * @param bool $flash Create Flash notifications
     *
     * @return array|bool
     */
    public function determineApp($appID, $admin = null, $userID = null, $set = true, $full = true, $flash = null)
    {
        if (is_null($flash)) {
            $flash = $set;
        }

        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        $this->Invoices = TableRegistry::getTableLocator()->get('Invoices');

        $this->Controller = $this->_registry->getController();

        // Get Application
        /** @var \App\Model\Entity\Application $application */
        $application = $this->Applications->get($appID, ['contain' => 'Invoices']);

        // Determine Invoice Progress
        $invCount = $application->has('invoice') ? 1 : 0;

        // Find Cub, YL & Leader Counts
        $appNumbers = $this->Availability->getApplicationNumbers($appID);

        $attCubs = $appNumbers['NumSection'];
        $attYls = $appNumbers['NumNonSection'];
        $attLeaders = $appNumbers['NumLeaders'];

        $attNotCubs = $attYls + $attLeaders;

        $invCubs = 0;
        $invYls = 0;
        $invLeaders = 0;
        $invNotCubs = 0;

        if ($application->has('invoice')) {
            $invoiceNumbers = $this->Availability->getInvoiceNumbers($application->invoice->id);

            $invCubs = $invoiceNumbers['NumSection'];
            $invYls = $invoiceNumbers['NumNonSection'];
            $invLeaders = $invoiceNumbers['NumLeaders'];
            $invNotCubs = $invYls + $invLeaders;
        }

        $sumValues = 0;
        $sumPayments = 0;

        if ($invCount > 0) {
            $sumValues = $this->Invoices
                ->find('totalInitialValue')
                ->where(['id' => $application->invoice->id])
                ->first()
                ->sum;
            $sumPayments = $this->Invoices
                ->find('totalValue')
                ->where(['id' => $application->invoice->id])
                ->first()
                ->sum;
        }

        $sumBalances = $sumValues - $sumPayments;

        $appDone = 1; // Set at 100% because an application has been created.
        $invDone = 0;
        $cubsDone = 0;
        $payDone = 0;
        $cubsNotDone = 0;
        $status = 'danger';

        if ($invCount > 1) {
            if ($flash == true) {
                $this->Flash->error(__('There are Multiple Invoices on one Application.'));
            }
            $invDone = 0.5;
        } elseif ($invCount == 1) {
            $invDone = 1;
        }

        if ($attCubs > 0 && $invCubs > 0 && $invCubs >= $attCubs) {
            $addCubs = $invCubs - $attCubs;
            $cubsDone = $attCubs / $invCubs;

            if ($set == true) {
                $this->Controller->set(compact('addCubs'));
            }
        } elseif ($attCubs > 0 && $invCubs < $attCubs) {
            if ($flash == true) {
                $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Cubs.'));
            }
            $invDone = 0;
            if ($invCount > 1) {
                $invDone = 0.5;
            } elseif ($invCount == 1) {
                $invDone = 0.5;
            }
            $cubsDone = 1;
        }

        if ($attNotCubs > 0 && $invNotCubs > 0 && $invNotCubs >= $attNotCubs) {
            $addNotCubs = $invNotCubs - $attNotCubs;
            $cubsNotDone = $attNotCubs / $invNotCubs;

            if ($set == true) {
                $this->Controller->set(compact('addNotCubs'));
            }
        } elseif ($attNotCubs > 0 && $invNotCubs < $attNotCubs) {
            if ($flash == true) {
                $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Leaders & Young Leaders.'));
            }
            $invDone = 0;
            if ($invCount > 1) {
                $invDone = 0.5;
            } elseif ($invCount == 1) {
                $invDone = 1; //0.5;
            }
            $cubsNotDone = 1;
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
        }

        if ($set == true) {
            $this->Controller->set(compact('invCount'));
            $this->Controller->set(compact('attCubs', 'attYls', 'attLeaders', 'attNotCubs'));
            $this->Controller->set(compact('invCubs', 'invYls', 'invLeaders', 'invNotCubs'));
            $this->Controller->set(compact('sumBalances', 'sumPayments', 'sumValues'));
            $this->Controller->set(compact('appDone', 'invDone', 'cubsDone', 'cubsNotDone', 'payDone'));
            $this->Controller->set(compact('done', 'status'));
        }

        $simpleResults = [
            'done' => $done,
            'appDone' => $appDone,
            'invDone' => $invDone,
            'cubsDone' => $cubsDone,
            'cubsNotDone' => $cubsNotDone,
            'payDone' => $payDone,
            'status' => $status,
        ];

        if ($set == false && $full == false) {
            return $simpleResults;
        }

        $results = [
            'invCount' => $invCount,
            'invCubs' => $invCubs,
            'invYls' => $invYls,
            'invLeaders' => $invLeaders,
            'invNotCubs' => $invNotCubs,
            'attCubs' => $attCubs,
            'attYls' => $attYls,
            'attLeaders' => $attLeaders,
            'attNotCubs' => $attNotCubs,
            'sumBalances' => $sumBalances,
            'sumPayments' => $sumPayments,
            'sumValues' => $sumValues,
        ];

        if ($set == false && $full == true) {
            $fullResults = array_merge($results, $simpleResults);

            return $fullResults;
        }
    }

    /**
     * @param int $userID The ID of the User
     *
     * @return void
     */
    public function cacheApps($userID)
    {
        $usrs = TableRegistry::get('Users');

        $user = $usrs->get($userID, [
            'contain' => [
                'Applications.Events' => [
                    'conditions' => [
                        'Events.live' => true,
                    ],
                ],
            ],
        ]);
        $appProgress = [];

        if (! empty($user->applications)) {
            foreach ($user->applications as $applications => $applications) {
                $appProgress = ['this' => 'is a new value'];

                //$this->determineApp($applications->id, false, $userID, false, false, false);

                //arraypush($appProgress, [$applications->id => $simpleResults->done]);
            }
        }

        $userAppProgress = 'appProgress' . $userID;
        Cache::write($userAppProgress, $appProgress);
    }
}
