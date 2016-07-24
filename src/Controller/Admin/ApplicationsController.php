<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ApplicationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Attendees']
            , 'conditions' => ['Events.live' => true]
            , 'order' => ['modified' => 'DESC']
        ];

        

        $this->set('applications', $this->paginate($this->Applications));
        $this->set('_serialize', ['applications']);
    }

    public function bookings($eventID = null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Attendees', 'Invoices'],
            'conditions' => ['event_id' => $eventID]
        ];
        $this->set('applications', $this->paginate($this->Applications));
        $this->set('_serialize', ['applications']);
    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $invs = TableRegistry::get('Invoices');
        $atts = TableRegistry::get('Attendees');
        $itms = TableRegistry::get('InvoiceItems');

        $invoices = $invs->find('all')->where(['application_id' => $id]);
        $invCount = $invoices->count('*');
        $invFirst = $invs->find('all')->where(['application_id' => $id])->first();
        $this->set(compact('invCount', 'invFirst'));

        $attendeeCubCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $id, 't.deleted IS' => null]);

        $attendeeYlCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $id, 't.deleted IS' => null]);

        $attendeeLeaderCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.id' => $id, 't.deleted IS' => null]);
            
        $attCubs = $attendeeCubCount->count(['t.id']);
        $attYls = $attendeeYlCount->count(['t.id']);
        $attLeaders = $attendeeLeaderCount->count(['t.id']);

        $attNotCubs = $attYls + $attLeaders;
        $this->set(compact('attCubs', 'attYls', 'attLeaders', 'attNotCubs'));

        if ($invCount > 0) {
            $invItemCount = $itms->find('all')
                ->contain(['Invoices.Applications'])
                ->where(['Applications.id' => $id])
                ->count('*');

            if ($invItemCount > 0) {
                $invItemCounts = $itms->find('all')
                    ->contain(['Invoices.Applications'])
                    ->where(['Applications.id' => $id])
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
        $this->set(compact('invCubs', 'invYls', 'invLeaders', 'invNotCubs'));

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
        $this->set(compact('sumBalances', 'sumPayments', 'sumValues'));

        $appDone = 1; // Set at 100% because an application has been created.

        if ($invCount > 1) {
            $this->Flash->error(__('There are Multiple Invoices on one Application.'));
            $invDone = 0;
        } elseif ($invCount == 1) {
            $invDone = 1;
        } else {
            $invDone = 0;
        }

        if ($attCubs > 0 && $invCubs > 0 && $invCubs >= $attCubs) {
            $addCubs = $invCubs - $attCubs;
            $cubsDone = $attCubs / $invCubs;

            $this->set(compact('addCubs'));
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

            $this->set(compact('addNotCubs'));
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
        

        $this->set(compact('appDone', 'invDone', 'cubsDone', 'cubsNotDone', 'payDone'));

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

        $this->set(compact('done', 'status'));
    }

    public function pdfView($id = null)
    {
        // Insantiate Objects
        $application = $this->Applications->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
        ]);

        $this->viewBuilder()->options([
               'pdfConfig' => [
                   'orientation' => 'portrait',
                   'filename' => 'Invoice_' . $id
               ]
           ]);
        
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $invs = TableRegistry::get('Invoices');
        $atts = TableRegistry::get('Attendees');
        $itms = TableRegistry::get('InvoiceItems');
        $evts = TableRegistry::get('Events');

        $event = $evts->get($application->event_id);

        $invoices = $invs->find('all')->where(['application_id' => $id]);
        $invCount = $invoices->count('*');
        $invFirst = $invs->find('all')->where(['application_id' => $id])->first();
        $this->set(compact('invCount', 'invFirst'));

        $attendeeCubCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $id, 't.deleted IS' => null]);

        $attendeeYlCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $id, 't.deleted IS' => null]);

        $attendeeLeaderCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 0, 'Applications.id' => $id, 't.deleted IS' => null]);
            
        $attCubs = $attendeeCubCount->count(['t.id']);
        $attYls = $attendeeYlCount->count(['t.id']);
        $attLeaders = $attendeeLeaderCount->count(['t.id']);

        $attNotCubs = $attYls + $attLeaders;
        $this->set(compact('attCubs', 'attYls', 'attLeaders', 'attNotCubs'));

        if ($invCount > 0) {
            $invItemCount = $itms->find('all')
                ->contain(['Invoices.Applications'])
                ->where(['Applications.id' => $id])
                ->count('*');

            if ($invItemCount > 0) {
                $invItemCounts = $itms->find('all')
                    ->contain(['Invoices.Applications'])
                    ->where(['Applications.id' => $id])
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
        $this->set(compact('invCubs', 'invYls', 'invLeaders', 'invNotCubs'));

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
        $this->set(compact('sumBalances', 'sumPayments', 'sumValues'));

        $appDone = 1; // Set at 100% because an application has been created.

        if ($invCount > 1) {
            $this->Flash->error(__('There are Multiple Invoices on one Application.'));
            $invDone = 0;
        } elseif ($invCount == 1) {
            $invDone = 1;
        } else {
            $invDone = 0;
        }

        if ($attCubs > 0 && $invCubs > 0 && $invCubs >= $attCubs) {
            $addCubs = $invCubs - $attCubs;
            $cubsDone = $attCubs / $invCubs;

            $this->set(compact('addCubs'));
        } elseif ($attCubs > 0 && $invCubs < $attCubs) {
            $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Cubs.'));
            $invDone = 0.5;
            $cubsDone = 1;
        } else {
            $cubsDone = 0;
        }

        if ($attNotCubs > 0 && $invNotCubs > 0 && $invNotCubs >= $attNotCubs) {
            $addNotCubs = $invNotCubs - $attNotCubs;
            $cubsNotDone = $attNotCubs / $invNotCubs;

            $this->set(compact('addNotCubs'));
        } elseif ($attNotCubs > 0 && $invNotCubs < $attNotCubs) {
            $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Leaders & Young Leaders.'));
            $invDone = 0.5;
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
        

        $this->set(compact('appDone', 'invDone', 'cubsDone', 'cubsNotDone', 'payDone'));

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

        $this->set(compact('done', 'status'));

        $CakePdf = new \CakePdf\Pdf\CakePdf();
        $CakePdf->template('application', 'default');
        $CakePdf->viewVars($this->viewVars);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Applications' . DS . 'Application #' . $id . '.pdf');

        $this->redirect(['controller' => 'Applications', 'action' => 'view', $application->id, '_ext' => 'pdf']);
    }

    public function eventPdf($eventId = null)
    {
        if (isset($eventId)) {
            $invs = TableRegistry::get('Invoices');
            $atts = TableRegistry::get('Attendees');
            $itms = TableRegistry::get('InvoiceItems');
            $evts = TableRegistry::get('Events');

            $event = $evts->get($eventId, ['contain' => ['Applications']]);

            foreach ($event->applications as $applications) {
                // Insantiate Objects
                $application = $this->Applications->get($applications->id, [
                    'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['sort' => ['Attendees.role_id' => 'ASC', 'Attendees.lastname' => 'ASC'], 'Roles', 'Scoutgroups', 'Allergies'], 'Notes']
                ]);

                $this->viewBuilder()->options([
                       'pdfConfig' => [
                           'orientation' => 'portrait',
                           'filename' => 'Application ' . $application->id
                       ]
                   ]);
                
                $this->set('application', $application);
                $this->set('_serialize', ['application']);

                $id = $application->id;

                $invoices = $invs->find('all')->where(['application_id' => $id]);
                $invCount = $invoices->count('*');
                $invFirst = $invs->find('all')->where(['application_id' => $id])->first();
                $this->set(compact('invCount', 'invFirst'));

                $attendeeCubCount = $this->Applications->find()
                    ->hydrate(false)
                    ->join([
                        'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                        't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                        'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
                    ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $id, 't.deleted IS' => null]);

                $attendeeYlCount = $this->Applications->find()
                    ->hydrate(false)
                    ->join([
                        'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                        't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                        'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
                    ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $id, 't.deleted IS' => null]);

                $attendeeLeaderCount = $this->Applications->find()
                    ->hydrate(false)
                    ->join([
                        'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id', ],
                        't' => ['table' => 'attendees', 'type' => 'INNER', 'conditions' => 't.id = x.attendee_id', ],
                        'r' => ['table' => 'roles', 'type' => 'INNER', 'conditions' => 'r.id = t.role_id']
                    ])->where(['r.minor' => 0, 'Applications.id' => $id, 't.deleted IS' => null]);
                    
                $attCubs = $attendeeCubCount->count(['t.id']);
                $attYls = $attendeeYlCount->count(['t.id']);
                $attLeaders = $attendeeLeaderCount->count(['t.id']);

                $attNotCubs = $attYls + $attLeaders;
                $this->set(compact('attCubs', 'attYls', 'attLeaders', 'attNotCubs'));

                if ($invCount > 0) {
                    $invItemCount = $itms->find('all')
                        ->contain(['Invoices.Applications'])
                        ->where(['Applications.id' => $id])
                        ->count('*');

                    if ($invItemCount > 0) {
                        $invItemCounts = $itms->find('all')
                            ->contain(['Invoices.Applications'])
                            ->where(['Applications.id' => $id])
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
                $this->set(compact('invCubs', 'invYls', 'invLeaders', 'invNotCubs'));

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
                $this->set(compact('sumBalances', 'sumPayments', 'sumValues'));

                $appDone = 1; // Set at 100% because an application has been created.

                if ($invCount > 1) {
                    //$this->Flash->error(__('There are Multiple Invoices on one Application.'));
                    $invDone = 0;
                } elseif ($invCount == 1) {
                    $invDone = 1;
                } else {
                    $invDone = 0;
                }

                if ($attCubs > 0 && $invCubs > 0 && $invCubs >= $attCubs) {
                    $addCubs = $invCubs - $attCubs;
                    $cubsDone = $attCubs / $invCubs;

                    $this->set(compact('addCubs'));
                } elseif ($attCubs > 0 && $invCubs < $attCubs) {
                    //$this->Flash->error(__('Your Invoice is not Reflective of Your Number of Cubs.'));
                    $invDone = 0.5;
                    $cubsDone = 1;
                } else {
                    $cubsDone = 0;
                }

                if ($attNotCubs > 0 && $invNotCubs > 0 && $invNotCubs >= $attNotCubs) {
                    $addNotCubs = $invNotCubs - $attNotCubs;
                    $cubsNotDone = $attNotCubs / $invNotCubs;

                    $this->set(compact('addNotCubs'));
                } elseif ($attNotCubs > 0 && $invNotCubs < $attNotCubs) {
                    //$this->Flash->error(__('Your Invoice is not Reflective of Your Number of Leaders & Young Leaders.'));
                    $invDone = 0.5;
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
                

                $this->set(compact('appDone', 'invDone', 'cubsDone', 'cubsNotDone', 'payDone'));

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

                $this->set(compact('done', 'status'));

                $CakePdf = new \CakePdf\Pdf\CakePdf();
                $CakePdf->template('application', 'default');
                $CakePdf->viewVars($this->viewVars);
                // Get the PDF string returned
                $pdf = $CakePdf->output();
                // Or write it to file directly
                $pdf = $CakePdf->write(FILES . DS . 'Event ' . $event->id . DS . 'Applications' . DS . 'Application #' . $id . '.pdf');
            }
        }

        $this->redirect(['controller' => 'Events', 'action' => 'full_view', $event->id]);
    }

    public function query($id = null)
    {
        $invs = TableRegistry::get('Invoices');

        $invCount = $invs->find('all')->where(['application_id' => $id])->count();

        if ($invCount = 1) {
            $this->Flash->success(__('This Application has a single Invoice. No action required.'));
            return $this->redirect(['action' => 'index']);
        } elseif ($invCount = 0) {
            return $this->redirect(['controller' => 'Notifications', 'action' => 'noInv', 'prefix' => 'admin', $id]);
        } else {
            return $this->redirect(['controller' => 'Notifications', 'action' => 'multipleInv', 'prefix' => 'admin', $id]);
        }
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        if (isset($userId)) {
            $usrs = TableRegistry::get('Users');

            $user = $usrs->get($userId, ['contain' => ['Roles', 'Applications', 'Scoutgroups']]);
            $userScoutGroup = $user->scoutgroup_id;
        }

        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            $newData = ['modification' => 0];
            $application = $this->Applications->patchEntity($application, $newData);

            $application = $this->Applications->patchEntity($application, $this->request->data);

            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'view', $application->id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        

        if (isset($userId)) {
            $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userId]]);
        } else {
            $attendees = $this->Applications->Attendees->find('list', ['limit' => 200]);
        }

        $users = $this->Applications->Users->find('list', ['limit' => 200]);
        $users = $this->Applications->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        
        $this->set(compact('application', 'users', 'attendees', 'scoutgroups', 'events'));
        $this->set('_serialize', ['application']);

        //$startuser = $this->Applications->Users->find('all',['conditions' => ['user_id' => $userId]])->first()->user_id;

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['user_id'] = $userId;
            if (isset($userScoutGroup)) {
                $this->request->data['scoutgroup_id'] = $userScoutGroup;
            }
        }
              
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Events', 'Scoutgroups', 'Users']
        ]);

        $users = TableRegistry::get('Users');
        $user = $users->get($application->user_id);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'view', $application->id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $users = $this->Applications->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $application->user_id]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $user->scoutgroup_id]]);
        $this->set(compact('application', 'users', 'attendees', 'events', 'scoutgroups'));
        $this->set('_serialize', ['application']);
    }

    public function link($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Attendees', 'Events', 'Scoutgroups', 'Users']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'view', $application->id]);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $application->user_id]]);
        $this->set(compact('application', 'attendees'));
        $this->set('_serialize', ['application']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($id);
        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {

        // Admin can access every action
        if (isset($user['authrole']) && $user['authrole'] === 'admin') {
            return true;
        }

        if ($this->request->action === 'add') {
                return true;
        }

        if (in_array($this->request->action, ['edit', 'delete'])) {
            if ($this->applications->isOwnedBy($application['user_id'], $user['id'])) {
                return true;
            }

            // Check that the application belongs to the current user.
            $application = $this->Applications->get($id);
            
            if ($application->user_id == $user['id']) {
                return true;
            }
        }
    }
}
