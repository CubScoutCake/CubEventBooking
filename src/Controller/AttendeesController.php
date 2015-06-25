<?php
namespace App\Controller;

use App\Controller\AppController;

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
            'contain' => ['Users']
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
            'contain' => ['Users', 'Applications', 'Allergies']
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
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $this->set(compact('attendee', 'users', 'applications', 'allergies'));
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
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $this->set(compact('attendee', 'users', 'applications', 'allergies'));
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
}
