<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sections Controller
 *
 * @property \App\Model\Table\SectionsTable $Sections
 */
class SectionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SectionTypes', 'Scoutgroups']
        ];
        $sections = $this->paginate($this->Sections);

        $this->set(compact('sections'));
        $this->set('_serialize', ['sections']);
    }

    /**
     * View method
     *
     * @param string|null $id Section id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $section = $this->Sections->get($id, [
            'contain' => ['SectionTypes', 'Scoutgroups', 'Applications', 'Attendees', 'Users']
        ]);

        $this->set('section', $section);
        $this->set('_serialize', ['section']);
    }

    /**
     * Edit method
     *
     * @param string|null $sectionId Section id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($sectionId = null)
    {
        if ($this->Auth->user('section_id') <> $sectionId) {
            $this->Flash->error('You can only edit your own section');
            $errorMsg = 'SECTION:EDIT:' . $sectionId . ' edited without authorisation User:' . $this->Auth->user('id');
            $this->log($errorMsg, 'notice');

            return $this->redirect(['action' => 'view']);
        }

        $section = $this->Sections->get($sectionId, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $section = $this->Sections->patchEntity($section, $this->request->data);
            if ($this->Sections->save($section)) {
                $this->Flash->success(__('The section has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section could not be saved. Please, try again.'));
            }
        }
        $sectionTypes = $this->Sections->SectionTypes->find('list', ['limit' => 200]);
        $scoutgroups = $this->Sections->Scoutgroups->find('list', ['limit' => 200]);
        $this->set(compact('section', 'sectionTypes', 'scoutgroups'));
        $this->set('_serialize', ['section']);
    }
}
