<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SectionTypes Controller
 *
 * @property \App\Model\Table\SectionTypesTable $SectionTypes
 */
class SectionTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $sectionTypes = $this->paginate($this->SectionTypes);

        $this->set(compact('sectionTypes'));
        $this->set('_serialize', ['sectionTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Section Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sectionType = $this->SectionTypes->get($id, [
            'contain' => ['Roles', 'Sections']
        ]);

        $this->set('sectionType', $sectionType);
        $this->set('_serialize', ['sectionType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sectionType = $this->SectionTypes->newEntity();
        if ($this->request->is('post')) {
            $sectionType = $this->SectionTypes->patchEntity($sectionType, $this->request->data);
            if ($this->SectionTypes->save($sectionType)) {
                $this->Flash->success(__('The section type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section type could not be saved. Please, try again.'));
            }
        }
        $roles = $this->SectionTypes->Roles->find('list', ['limit' => 200]);
        $this->set(compact('sectionType', 'roles'));
        $this->set('_serialize', ['sectionType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Section Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sectionType = $this->SectionTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sectionType = $this->SectionTypes->patchEntity($sectionType, $this->request->data);
            if ($this->SectionTypes->save($sectionType)) {
                $this->Flash->success(__('The section type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The section type could not be saved. Please, try again.'));
            }
        }
        $roles = $this->SectionTypes->Roles->find('list', ['limit' => 200]);
        $this->set(compact('sectionType', 'roles'));
        $this->set('_serialize', ['sectionType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Section Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sectionType = $this->SectionTypes->get($id);
        if ($this->SectionTypes->delete($sectionType)) {
            $this->Flash->success(__('The section type has been deleted.'));
        } else {
            $this->Flash->error(__('The section type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
