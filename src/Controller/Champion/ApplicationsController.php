<?php
namespace App\Controller\Champion;

use App\Controller\Champion\AppController;
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
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $this->paginate = [
            'contain' => ['Users','Scoutgroups', 'Events'], 'conditions' => [   
                'Scoutgroups.district_id' => $champD->district_id]
        ];  
        $this->set('applications', $this->paginate($this->Applications));
        $this->set('_serialize', ['applications']);
    }

    public function bookings($eventID = null)
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Events'],
            'conditions' => ['event_id' => $eventID, 'Scoutgroups.district_id' => $champD->district_id]
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
            'contain' => ['Users', 'Attendees', 'Events', 'Invoices', 'Scoutgroups']
        ]);
        $this->set('application', $application);
        $this->set('_serialize', ['application']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        if (isset($userId)) {

            $usrs = TableRegistry::get('Users');

            $user = $usrs->get($userId, ['contain' => ['Roles','Applications','Scoutgroups']]);
            $userScoutGroup = $user->scoutgroup_id;
        }

        $application = $this->Applications->newEntity();
        if ($this->request->is('post')) {
            
            $newData = ['modification' => 0];
            $application = $this->Applications->patchEntity($application, $newData);

            $application = $this->Applications->patchEntity($application, $this->request->data);

            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        

        if (isset($userId)) {
            $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $userId]]);
        } else {
            $attendees = $this->Applications->Attendees->find('list', ['contain' => 'Scoutgroups', 'limit' => 200,'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        }

        $users = $this->Applications->Users->find('list', ['limit' => 200, 'contain' => 'Scoutgroups', 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]]);
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['district_id' => $champD->district_id]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['live' => 1]]);
        
        $this->set(compact('application', 'users', 'attendees', 'scoutgroups','events'));
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
            'contain' => ['Attendees','Events', 'Scoutgroups','Users']
        ]);

        $users = TableRegistry::get('Users');
        $user = $users->get($application->user_id);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->data);
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
            }
        }
        $users = $this->Applications->Users->find('list', ['limit' => 200, 'conditions' => ['id' => $application->user_id]]);
        $attendees = $this->Applications->Attendees->find('list', ['limit' => 200, 'conditions' => ['user_id' => $application->user_id]]);
        $events = $this->Applications->Events->find('list', ['limit' => 200, 'conditions' => ['live' => 1]]);
        $scoutgroups = $this->Applications->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $user->scoutgroup_id]]);
        $this->set(compact('application', 'users', 'attendees','events','scoutgroups'));
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

        if (isset($user['authrole']) && $user['authrole'] === 'champion') {
            return true;
        }

        /*if (in_array($this->request->action, ['edit', 'view', 'delete'])) {
            $applicationId = (int)$this->request->params['pass'][0];
            if ($this->Applications->isChampedBy($applicationId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }*/

        return parent::isAuthorized($user);
    }

}
