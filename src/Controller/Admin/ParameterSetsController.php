<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * ParameterSets Controller
 *
 * @property \App\Model\Table\ParameterSetsTable $ParameterSets
 */
class ParameterSetsController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $parameterSets = $this->paginate($this->ParameterSets);

        $this->set(compact('parameterSets'));
        $this->set('_serialize', ['parameterSets']);
    }

    /**
     * View method
     *
     * @param string|null $id Parameter Set id.
     *
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parameterSet = $this->ParameterSets->get($id, [
            'contain' => [],
        ]);

        $this->set('parameterSet', $parameterSet);
        $this->set('_serialize', ['parameterSet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parameterSet = $this->ParameterSets->newEntity();
        if ($this->request->is('post')) {
            $parameterSet = $this->ParameterSets->patchEntity($parameterSet, $this->request->getData());
            if ($this->ParameterSets->save($parameterSet)) {
                $this->Flash->success(__('The parameter set has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameter set could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parameterSet'));
        $this->set('_serialize', ['parameterSet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parameter Set id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parameterSet = $this->ParameterSets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parameterSet = $this->ParameterSets->patchEntity($parameterSet, $this->request->getData());
            if ($this->ParameterSets->save($parameterSet)) {
                $this->Flash->success(__('The parameter set has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameter set could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parameterSet'));
        $this->set('_serialize', ['parameterSet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parameter Set id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parameterSet = $this->ParameterSets->get($id);
        if ($this->ParameterSets->delete($parameterSet)) {
            $this->Flash->success(__('The parameter set has been deleted.'));
        } else {
            $this->Flash->error(__('The parameter set could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
