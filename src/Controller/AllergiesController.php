<?php
namespace App\Controller;

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
     * @param string|null $allergyId Allergy id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($allergyId = null)
    {
        $allergy = $this->Allergies->get($allergyId, [
            'contain' => ['Attendees']
        ]);
        $this->set('allergy', $allergy);
        $this->set('_serialize', ['allergy']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allergy = $this->Allergies->newEntity();

        if ($this->request->is('post')) {
            $allergy = $this->Allergies->patchEntity($allergy, $this->request->getData(), ['accessibleFields' => ['id' => true]]);
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
}
