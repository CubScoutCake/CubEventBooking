<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
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
            'contain' => ['Users', 'Scoutgroups', 'Events'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        $this->set('applications', $this->paginate($this->Applications));
        $this->set('_serialize', ['applications']);
    }

    public function bookings($eventID = null)
    {
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Events'],
            'conditions' => ['user_id' => $this->Auth->user('id'), 'event_id' => $eventID]
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
            'contain' => ['Users', 'Scoutgroups', 'Events', 'Invoices', 'Attendees' => ['conditions' => ['user_id' => $this->Auth->user('id')]]]
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);

        $invs = TableRegistry::get('Invoices');
        $atts = TableRegistry::get('Attendees');
        $itms = TableRegistry::get('InvoiceItems');

        $invoices = $invs->find('all')->where(['application_id' => $id]);
        $invCount = $invoices->count('*');
        $this->set(compact('invCount'));

        $attendeeCubCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id' => 1, 'Applications.id' => $id]);

        $attendeeYlCount = $this->Applications->find()
            ->hydrate(false)
            ->join([
                'x' => ['table' => 'applications_attendees', 'type' => 'LEFT', 'conditions' => 'x.application_id = Applications.id',],
                't' => ['table' => 'attendees','type' => 'INNER','conditions' => 't.id = x.attendee_id',],
                'r' => ['table' => 'roles','type' => 'INNER','conditions' => 'r.id = t.role_id']
            ])->where(['r.minor' => 1, 't.role_id <>' => 1, 'Applications.id' => $id]);

        $attendeeLeaderCount = $this->Applications->find()
            ->hydrate(false)
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
        $this->set(compact('invCubs','invYls','invLeaders','invNotCubs'));

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
        $this->set(compact('sumBalances','sumPayments','sumValues'));

        $appDone = 1; // Set at 100% because an application has been created.

        if ($invCount > 1) {
            $this->Flash->error(__('There are Multiple Invoices on one Application.'));
            $invDone = 0;
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
            $this->Flash->error(__('Your Invoice is not Reflective of Your Number of Cubs.'));
            $invDone = 0.5;
            $cubsDone = 1;
        } else {
            $cubsDone = 0;
        }

        if ($attNotCubs > 0 && $invNotCubs > 0 && $invNotCubs >= $attNotCubs)  {
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
        

        $this->set(compact('appDone','invDone','cubsDone','cubsNotDone','payDone'));

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

        $this->set(compact('done','status'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($eventID = null)
    {
        $now = Time::now();

        $evts = TableRegistry::get('Events');

        if (isset($eventID)) {
            $applicationCount = $this->Applications->find('all')->where(['event_id' => $eventID])->count('*');
            $event = $evts->get($eventID);

            if ($applicationCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }
        }
        
        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {

        	// Check Max Applications

        	$evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);

            if ($appCount > $event->available_apps) {
            	$this->Flash->error(__('Apologies this Event is Full.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
            	$this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } else {
            	// Patch Data
            	$newData = ['modification' => 0, 'user_id' => $this->Auth->user('id')];
            	$application = $this->Applications->patchEntity($application, $newData);

            	$application = $this->Applications->patchEntity($application, $this->request->data);

            	if ($this->Applications->save($application)) {
            	    $redir = $application->get('id');
            	    $this->Flash->success(__('The application has been saved.'));
            	    return $this->redirect(['action' => 'view',$redir]);
            	} else {
            	    $this->Flash->error(__('The application could not be saved. Please, try again.'));
            	}
            }
        }

        // Get Options Lists
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('scoutgroup_id')]]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['end >' => $now, 'live' => 1]]);

        // Pass Variables
        $this->set(compact('application', 'users', 'scoutgroups', 'events', 'attendees'));
        $this->set('_serialize', ['application']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['event_id'] = $eventID;
        }
    }

    public function newApp($eventID = null)
    {
        $now = Time::now();

        $evts = TableRegistry::get('Events');

        if (isset($eventID)) {
            $applicationCount = $this->Applications->find('all')->where(['event_id' => $eventID])->count('*');
            $event = $evts->get($eventID);

            if ($applicationCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }
        }
        
        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {

        	// Check Max Applications

        	$evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);

            if ($appCount > $event->available_apps && isset($event->available_apps)) {
            	$this->Flash->error(__('Apologies this Event is Full.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } else {
            	// Patch Data
            	$newData = ['modification' => 0, 'user_id' => $this->Auth->user('id')];
            	$application = $this->Applications->patchEntity($application, $newData);

            	$application = $this->Applications->patchEntity($application, $this->request->data);

            	if ($this->Applications->save($application)) {

            	    $redir = $application->get('id');
            	    $this->Flash->success(__('The application has been saved.'));
            	    return $this->redirect(['controller' => 'Invoices', 'action' => 'generate', $redir]);
            	} else {
            	    $this->Flash->error(__('The application could not be saved. Please, try again.'));
            	}
            }
        }
        
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('scoutgroup_id')]]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['end >' => $now, 'live' => 1]]);
        
        $this->set(compact('application', 'users', 'scoutgroups', 'events', 'attendees'));
        $this->set('_serialize', ['application']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['event_id'] = $eventID;
        }
    }

    public function book($eventID = null)
    {
        $now = Time::now();

        $evts = TableRegistry::get('Events');

        if (isset($eventID)) {
            $applicationCount = $this->Applications->find('all')->where(['event_id' => $eventID])->count('*');
            $event = $evts->get($eventID);

            if ($applicationCount > $event->available_apps && isset($event->available_apps)) {
                $this->Flash->error(__('Apologies this Event is Full.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            }
        }
        
        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {

        	// Check Max Applications

        	$evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);

            if ($appCount > $event->available_apps && isset($event->available_apps)) {
            	$this->Flash->error(__('Apologies this Event is Full.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } elseif (!$event->new_apps) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
                return $this->redirect(['controller' => 'Landing', 'action' => 'user_home']);
            } else {
            	// Patch Data
            	$newData = ['modification' => 0, 'user_id' => $this->Auth->user('id')];
            	$application = $this->Applications->patchEntity($application, $newData);

            	$application = $this->Applications->patchEntity($application, $this->request->data);

            	if ($this->Applications->save($application)) {
            	    $redir = $application->get('id');
            	    $this->Flash->success(__('The application has been saved.'));
            	    return $this->redirect(['controller' => 'Attendees', 'action' => 'cub', $redir]);
            	} else {
            	    $this->Flash->error(__('The application could not be saved. Please, try again.'));
            	}
            }
        }
        
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('scoutgroup_id')]]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['id' => $eventID]]);
        $this->set(compact('application', 'users', 'scoutgroups', 'events', 'attendees'));
        $this->set('_serialize', ['application']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->data['event_id'] = $eventID;
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
            'contain' => ['Attendees']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            // Check Max Applications

            $evtID = $this->request->data['event_id'];

            $appCount = $this->Applications->find('all')->where(['event_id' => $evtID])->count('*');
            $event = $evts->get($evtID);

            /*if ($event->invoices_locked) {
                $this->Flash->error(__('Apologies this Event is Currently Locked.'));
                return $this->redirect(['controller' => 'Applications'
                    , 'action' => 'view'
                    , 'prefix' => false
                    , $id]);
            } else {*/
                $newData = ['user_id' => $this->Auth->user('id'), 'modification' => 'modification' + 1];
                $application = $this->Applications->patchEntity($application, $newData);
                $application = $this->Applications->patchEntity($application, $this->request->data);
                if ($this->Applications->save($application)) {
                    $this->Flash->success(__('The application has been saved.'));
                    return $this->redirect(['action' => 'view',$id]);
                } else {
                    $this->Flash->error(__('The application could not be saved. Please, try again.'));
                }
            // }
        }
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200]);
        $this->set(compact('application', 'users', 'scoutgroups', 'events', 'attendees'));
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
        // All registered users can add articles
        if (in_array($this->request->action, ['add', 'book', 'index'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['edit', 'view', 'delete'])) {
            $applicationId = (int)$this->request->params['pass'][0];
            if ($this->Applications->isOwnedBy($applicationId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
