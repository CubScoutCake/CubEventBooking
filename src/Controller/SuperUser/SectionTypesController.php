<?php
declare(strict_types=1);

namespace App\Controller\SuperUser;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles'],
        ];
        $sectionTypes = $this->paginate($this->SectionTypes);

        $this->set(compact('sectionTypes'));
        $this->set('_serialize', ['sectionTypes']);
    }

    /**
     * View method
     *
     * @param string|null $sectionTypeId Section Type id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($sectionTypeId = null)
    {
        $sectionType = $this->SectionTypes->get($sectionTypeId, [
            'contain' => ['Roles', 'Sections'],
        ]);

        $this->set('sectionType', $sectionType);
        $this->set('_serialize', ['sectionType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sectionType = $this->SectionTypes->newEntity();
        if ($this->request->is('post')) {
            $sectionType = $this->SectionTypes->patchEntity($sectionType, $this->request->getData());
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
     * @param string|null $sectionTypeId Section Type id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($sectionTypeId = null)
    {
        $sectionType = $this->SectionTypes->get($sectionTypeId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sectionType = $this->SectionTypes->patchEntity($sectionType, $this->request->getData());
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
     * @param string|null $sectionTypeId Section Type id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($sectionTypeId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sectionType = $this->SectionTypes->get($sectionTypeId);
        if ($this->SectionTypes->delete($sectionType)) {
            $this->Flash->success(__('The section type has been deleted.'));
        } else {
            $this->Flash->error(__('The section type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
