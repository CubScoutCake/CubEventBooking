<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Attendees Controller
 *
 * @property \App\Model\Table\AttendeesTable $Attendees
 */
class AttendeesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Roles'],
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        $this->set('attendees', $this->paginate($this->Attendees));
        $this->set('_serialize', ['attendees']);
    }

    /**
     * View method
     *
     * @param string|null $id Attendee id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendee = $this->Attendees->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications' => [
            'conditions' => ['user_id' => $this->Auth->user('id')]
            ], 'Allergies']
        ]);
        $this->set('attendee', $attendee);
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adult($appId = null)
    {
        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $attendee->user_id = $this->Auth->user('id');

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The Adult has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Adult could not be saved. Please, try again.'));
            }
        }

        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('scoutgroup_id')]]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200, 'conditions' => ['minor' => 0]]);        
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'scoutgroups', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);

        if ($this->request->is('get')) {
            
            // Values from the Model e.g.
            $this->request->data['application_id'] = $appId;
        }
              
    }


    public function cub($appId = null)
    {
        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $attendee->user_id = $this->Auth->user('id');

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The Cub has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Cub could not be saved. Please, try again.'));
            }
        }

        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('scoutgroup_id')]]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200, 'conditions' => ['minor' => 1]]);         
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'scoutgroups', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);

        if ($this->request->is('get')) {
            
            // Values from the Model e.g.
            $this->request->data['application_id'] = $appId;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendee id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attendee = $this->Attendees->get($id, [
            'contain' => ['Applications', 'Allergies', 'Users', 'Scoutgroups', 'Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200,'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $this->set(compact('attendee', 'users', 'scoutgroups', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendee id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendee = $this->Attendees->get($id);
        if ($this->Attendees->delete($attendee)) {
            $this->Flash->success(__('The attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The attendee could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function locateCount($roleId = null, $appId = null)
    {
        $attendees = TableRegistry::get('Attendees');

        $total = $attendees->find()->where(['role_id' => 1])->count(['id']);

        //$results = $total->count(*);

        $data = $total;

        //$total = $attendees->find('all', ['conditions' => ['Attendees.role_id' => 2]]);

        //$total = $attendees->find('list');

        //$data = $total->count();

        //$data = $total->fetchColumn(0);

        $this->set('data',$data);

        //$fish = $attendees->find();
        //$fish->select([$fish->func()->count('Attendees.id')])
        //->where()

        //->contain(['Applications.Attendees'])
        //->where(['role_id' => $roleId, 'Applications.id' => $appId])
        //->group(['Applications.id']);

        //$total = $fish;

    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['index', 'adult', 'cub'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['edit', 'view', 'delete'])) {
            $attendeeId = (int)$this->request->params['pass'][0];
            if ($this->Attendees->isOwnedBy($attendeeId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }

    
}
