<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AttendeesAllergies Controller
 *
 * @property \App\Model\Table\AttendeesAllergiesTable $AttendeesAllergies
 */
class AttendeesAllergiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Attendees', 'Allergies']
        ];
        $attendeesAllergies = $this->paginate($this->AttendeesAllergies);

        $this->set(compact('attendeesAllergies'));
        $this->set('_serialize', ['attendeesAllergies']);
    }

    /**
     * View method
     *
     * @param string|null $id Attendees Allergy id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendeesAllergy = $this->AttendeesAllergies->get($id, [
            'contain' => ['Attendees', 'Allergies']
        ]);

        $this->set('attendeesAllergy', $attendeesAllergy);
        $this->set('_serialize', ['attendeesAllergy']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $attendeesAllergy = $this->AttendeesAllergies->newEntity();
        if ($this->request->is('post')) {
            $attendeesAllergy = $this->AttendeesAllergies->patchEntity($attendeesAllergy, $this->request->data);
            if ($this->AttendeesAllergies->save($attendeesAllergy)) {
                $this->Flash->success(__('The attendees allergy has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendees allergy could not be saved. Please, try again.'));
            }
        }
        $attendees = $this->AttendeesAllergies->Attendees->find('list', ['limit' => 200]);
        $allergies = $this->AttendeesAllergies->Allergies->find('list', ['limit' => 200]);
        $this->set(compact('attendeesAllergy', 'attendees', 'allergies'));
        $this->set('_serialize', ['attendeesAllergy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendees Allergy id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attendeesAllergy = $this->AttendeesAllergies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendeesAllergy = $this->AttendeesAllergies->patchEntity($attendeesAllergy, $this->request->data);
            if ($this->AttendeesAllergies->save($attendeesAllergy)) {
                $this->Flash->success(__('The attendees allergy has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendees allergy could not be saved. Please, try again.'));
            }
        }
        $attendees = $this->AttendeesAllergies->Attendees->find('list', ['limit' => 200]);
        $allergies = $this->AttendeesAllergies->Allergies->find('list', ['limit' => 200]);
        $this->set(compact('attendeesAllergy', 'attendees', 'allergies'));
        $this->set('_serialize', ['attendeesAllergy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendees Allergy id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendeesAllergy = $this->AttendeesAllergies->get($id);
        if ($this->AttendeesAllergies->delete($attendeesAllergy)) {
            $this->Flash->success(__('The attendees allergy has been deleted.'));
        } else {
            $this->Flash->error(__('The attendees allergy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
