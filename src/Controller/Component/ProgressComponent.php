<?php
namespace App\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class ProgressComponent extends Component
{
    public $components = ['Flash'];

    /**
     * A Function to Determine the Application
     *
     * @param int $appID The Application ID
     * @param bool $admin Is in Admin Scope (Reveal Others)
     * @param int $userID The ID of the Viewing User
     * @param bool $set Set Variables
     * @param bool $full Full Output
     * @param bool $flash Create Flash notifications
     * @return array|void
     */
    public function determineApp($appID, $admin = null, $userID = null, $set = true, $full = true, $flash = null)
    {
        if (!isset($set) || empty($set)) {
            $set = false;
        }

        if (!isset($full) || empty($full)) {
            $full = false;
        }

        if (!is_null($flash)) {
            $flash = $set;
        }

        $apps = TableRegistry::get('Applications');
        $invs = TableRegistry::get('Invoices');
        $atts = TableRegistry::get('Attendees');
        $itms = TableRegistry::get('InvoiceItems');

        $controller = $this->_registry->getController();

        // Get Application
        $app = $apps->get($appID, [
            'contain' => [
                'Users',
                'Sections.Scoutgroups',
                'Events',
                'Invoices',
                'Attendees' => [
                    'sort' => [
                        'Attendees.role_id' => 'ASC',
                        'Attendees.lastname' => 'ASC'
                    ]
                ],
                'Attendees.Roles',
                'Attendees.Sections.Scoutgroups'
            ]
        ]);

        if (isset($userID)) {
            $app = $apps->get($appID, [
                'contain' => [
                    'Users',
                    'Sections.Scoutgroups',
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
                    'Attendees.Sections.Scoutgroups' => [
                        'conditions' => [
                            'Attendees.user_id' => $userID
                        ]]]
            ]);
        }

        // Determine Invoice Progress
        $invoices = $invs->find('all')->where(['application_id' => $appID]);
        $invCount = $invoices->count();
        $invFirst = $invs->find('all')->where(['application_id' => $appID])->first();

        // Find Cub, YL & Leader Counts
        $attendeeCubCount = $apps->find('cubs')->where(['Applications.id' => $appID])->all();
        $attendeeYlCount = $apps->find('youngLeaders')->where(['Applications.id' => $appID])->all();
        $attendeeLeaderCount = $apps->find('leaders')->where(['Applications.id' => $appID])->all();

        $attCubs = $attendeeCubCount->count(['t.id']);
        $attYls = $attendeeYlCount->count(['t.id']);
        $attLeaders = $attendeeLeaderCount->count(['t.id']);

        $attNotCubs = $attYls + $attLeaders;

        $invCubs = 0;
        $invYls = 0;
        $invLeaders = 0;
	    $invNotCubs = 0;

        if ($invCount > 0) {
            $invMinorCount = $itms->find('all')
                ->contain(['Invoices.Applications', 'ItemTypes'])
	            ->where(['Applications.id' => $appID, 'ItemTypes.minor' => true])
	            ->count();

            if ($invMinorCount > 0) {
	            $invItemMinorCounts = $itms->find( 'all' )
                   ->contain( [ 'Invoices.Applications', 'ItemTypes' ] )
                   ->where( [ 'Applications.id' => $appID, 'ItemTypes.minor' => true ] )
                   ->select( [ 'sum' => $invoices->func()->sum( 'Quantity' ) ] )
                   ->toArray();

	            $invCubs = $invItemMinorCounts[0]->sum;
            }

	        $invAdultCount = $itms->find('all')
				->contain(['Invoices.Applications', 'ItemTypes'])
				->where(['Applications.id' => $appID, 'ItemTypes.minor' => true])
				->count();

            if ($invAdultCount > 0) {
	            $invItemAdultCounts = $itms->find('all')
	               ->contain(['Invoices.Applications', 'ItemTypes'])
	               ->where(['Applications.id' => $appID, 'ItemTypes.minor' => false])
	               ->select([ 'sum' => $invoices->func()->sum('Quantity')])
	               ->toArray();

	            $invNotCubs = $invItemAdultCounts[0]->sum;
            }
        }

        $sumValues = 0;
        $sumPayments = 0;

        if ($invCount > 0) {
            $sumValueItem = $invoices->select(['sum' => $invoices->func()->sum('initialvalue')])->group('id')->first();
            $sumPaymentItem = $invoices->select(['sum' => $invoices->func()->sum('value')])->group('id')->first();

            $sumValues = $sumValueItem->sum;
            $sumPayments = $sumPaymentItem->sum;
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
                $controller->set(compact('addCubs'));
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
                $controller->set(compact('addNotCubs'));
            }
        } elseif ($attNotCubs > 0 && $invNotCubs < $attNotCubs) {
            if ($flash == true) {
                $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Leaders & Young Leaders.'));
            }
            $invDone = 0;
            if ($invCount > 1) {
                $invDone = 0.5;
            } elseif ($invCount == 1) {
                $invDone = 0.5;
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
            $controller->set(compact('invCount', 'invFirst'));
            $controller->set(compact('attCubs', 'attYls', 'attLeaders', 'attNotCubs'));
            $controller->set(compact('invCubs', 'invYls', 'invLeaders', 'invNotCubs'));
            $controller->set(compact('sumBalances', 'sumPayments', 'sumValues'));
            $controller->set(compact('appDone', 'invDone', 'cubsDone', 'cubsNotDone', 'payDone'));
            $controller->set(compact('done', 'status'));
        }

        if ($set == false && $full == true) {
            $results = [
                'invCount' => $invCount,
                'invFirst' => $invFirst,
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
                'appDone' => $appDone,
                'invDone' => $invDone,
                'cubsDone' => $cubsDone,
                'cubsNotDone' => $cubsNotDone,
                'payDone' => $payDone,
                'done' => $done,
                'status' => $status,
            ];

            return $results;
        }

        if ($set == false && $full == false) {
            $simpleResults = [
                'done' => $done,
                'appDone' => $appDone,
                'invDone' => $invDone,
                'cubsDone' => $cubsDone,
                'cubsNotDone' => $cubsNotDone,
                'payDone' => $payDone,
                'status' => $status,
            ];

            return $simpleResults;
        }
    }

    /**
     * @param int $userID The ID of the User
     * @return void
     */
    public function cacheApps($userID)
    {
        $usrs = TableRegistry::get('Users');

        $user = $usrs->get($userID, ['contain' => ['Applications.Events' => ['conditions' => ['Events.live' => true]]]]);
        $appProgress = [];

        if (!empty($user->applications)) {
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
