<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

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
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications.Scoutgroups','Applications.Events','Allergies']
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
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications.Scoutgroups','Applications.Events','Allergies']
        ]);
        $this->set('attendee', $attendee);
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attendees->Users->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'order' => ['id' => DESC]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies','scoutgroups','roles'));
        $this->set('_serialize', ['attendee']);
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
            'contain' => ['Applications', 'Allergies']
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
        $users = $this->Attendees->Users->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200,'conditions' => ['user_id' => $attendee->user_id]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies','scoutgroups','roles'));
        $this->set('_serialize', ['attendee']);
    }

    public function update($id = null)
    {
        $attendee = $this->Attendees->get($id);

        $upperAttendee = ['firstname' => ucwords(strtolower($attendee->firstname))
            ,'lastname' => ucwords(strtolower($attendee->lastname))
            ,'address_1' => ucwords(strtolower($attendee->address_1))
            ,'address_2' => ucwords(strtolower($attendee->address_2))
            ,'city' => ucwords(strtolower($attendee->city))
            ,'county' => ucwords(strtolower($attendee->county))
            ,'postcode' => strtoupper($attendee->postcode)];

        $attendee = $this->Attendees->patchEntity($attendee, $upperAttendee);

        if ($this->Attendees->save($attendee)) {
            $this->Flash->success(__('The attendee has been updated.'));
            return $this->redirect(['action' => 'view', $attendee->id]);
        } else {
            $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'view', $attendee->id]);
        }
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
}
