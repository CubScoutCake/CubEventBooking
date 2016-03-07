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
            $newData = ['user_id' => $this->Auth->user('id'), 'modification' => 'modification' + 1];
            $application = $this->Applications->patchEntity($application, $newData);
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
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
