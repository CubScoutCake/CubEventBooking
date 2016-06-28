<?php
namespace App\Controller\Champion;

use App\Controller\Champion\AppController;
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
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $this->paginate = [
            'contain' => ['Users', 'Applications.Events', 'Scoutgroups']
            , 'conditions' => ['Scoutgroups.district_id' => $champD->district_id]
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
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications.Scoutgroups', 'Applications.Events', 'Allergies']
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
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $upperAttendee = ['firstname' => ucwords(strtolower($attendee->firstname))
                , 'lastname' => ucwords(strtolower($attendee->lastname))
                , 'address_1' => ucwords(strtolower($attendee->address_1))
                , 'address_2' => ucwords(strtolower($attendee->address_2))
                , 'city' => ucwords(strtolower($attendee->city))
                , 'county' => ucwords(strtolower($attendee->county))
                , 'postcode' => strtoupper($attendee->postcode)];

            $attendee = $this->Attendees->patchEntity($attendee, $upperAttendee);

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attendees->Users->find('list', ['limit' => 200, 'contain' => ['Roles', 'Scoutgroups'],
            'conditions' => [
                'Scoutgroups.district_id' => $champD->district_id]]);

        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'contain' => ['Users.Scoutgroups'],
            'conditions' => [
                'Scoutgroups.district_id' => $champD->district_id]]);

        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['district_id' => $champD->district_id]]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies', 'scoutgroups', 'roles'));
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
            'contain' => ['Applications', 'Allergies', 'Roles', 'Users', 'Scoutgroups']
        ]);

        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);

            $upperAttendee = ['firstname' => ucwords(strtolower($attendee->firstname))
                , 'lastname' => ucwords(strtolower($attendee->lastname))
                , 'address_1' => ucwords(strtolower($attendee->address_1))
                , 'address_2' => ucwords(strtolower($attendee->address_2))
                , 'city' => ucwords(strtolower($attendee->city))
                , 'county' => ucwords(strtolower($attendee->county))
                , 'postcode' => strtoupper($attendee->postcode)];

            $attendee = $this->Attendees->patchEntity($attendee, $upperAttendee);
            
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attendees->Users->find('list', ['limit' => 200, 'contain' => ['Roles', 'Scoutgroups'],
            'conditions' => [
                'Scoutgroups.district_id' => $champD->district_id]]);

        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'contain' => ['Users.Scoutgroups'],
            'conditions' => [
                'Scoutgroups.district_id' => $champD->district_id]]);

        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['district_id' => $champD->district_id]]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies', 'scoutgroups', 'roles'));
        $this->set('_serialize', ['attendee']);
    }

    public function update($id = null)
    {
        $attendee = $this->Attendees->get($id);

        $upperAttendee = ['firstname' => ucwords(strtolower($attendee->firstname))
            , 'lastname' => ucwords(strtolower($attendee->lastname))
            , 'address_1' => ucwords(strtolower($attendee->address_1))
            , 'address_2' => ucwords(strtolower($attendee->address_2))
            , 'city' => ucwords(strtolower($attendee->city))
            , 'county' => ucwords(strtolower($attendee->county))
            , 'postcode' => strtoupper($attendee->postcode)];

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
