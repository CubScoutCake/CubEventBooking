<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Allergies Controller
 *
 * @property \App\Model\Table\AllergiesTable $Allergies
 */
class AllergiesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('allergies', $this->paginate($this->Allergies));
        $this->set('_serialize', ['allergies']);
    }

    /**
     * View method
     *
     * @param string|null $id Allergy id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allergy = $this->Allergies->get($id, [
            'contain' => ['Attendees.Users', 'Attendees.Scoutgroups', 'Attendees.Roles']
        ]);
        $this->set('allergy', $allergy);
        $this->set('_serialize', ['allergy']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allergy = $this->Allergies->newEntity();

        if ($this->request->is('post')) {
            $allergy = $this->Allergies->newEntity($allergy, $this->request->data, ['accessibleFields' => ['id' => true]]);
            if ($this->Allergies->save($allergy)) {
                $this->Flash->success(__('The allergy has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allergy could not be saved. Please, try again.'));
            }
        }
        $attendees = $this->Allergies->Attendees->find('list', ['limit' => 200]);
        $this->set(compact('allergy', 'attendees'));
        $this->set('_serialize', ['allergy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Allergy id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allergy = $this->Allergies->get($id, [
            'contain' => ['Attendees']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allergy = $this->Allergies->patchEntity($allergy, $this->request->data);
            if ($this->Allergies->save($allergy)) {
                $this->Flash->success(__('The allergy has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The allergy could not be saved. Please, try again.'));
            }
        }
        $attendees = $this->Allergies->Attendees->find('list', ['limit' => 200]);
        $this->set(compact('allergy', 'attendees'));
        $this->set('_serialize', ['allergy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Allergy id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allergy = $this->Allergies->get($id);
        if ($this->Allergies->delete($allergy)) {
            $this->Flash->success(__('The allergy has been deleted.'));
        } else {
            $this->Flash->error(__('The allergy could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
