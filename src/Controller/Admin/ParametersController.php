<?php
namespace App\Controller\Admin;

/**
 * Parameters Controller
 *
 * @property \App\Model\Table\ParametersTable $Parameters
 */
class ParametersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $parameters = $this->paginate($this->Parameters);

        $this->set(compact('parameters'));
        $this->set('_serialize', ['parameters']);
    }

    /**
     * View method
     *
     * @param string|null $id Parameter id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parameter = $this->Parameters->get($id, [
            'contain' => ['Logistics']
        ]);

        $this->set('parameter', $parameter);
        $this->set('_serialize', ['parameter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parameter = $this->Parameters->newEntity();
        if ($this->request->is('post')) {
            $parameter = $this->Parameters->patchEntity($parameter, $this->request->getData());
            if ($this->Parameters->save($parameter)) {
                $this->Flash->success(__('The parameter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameter could not be saved. Please, try again.'));
            }
        }
        $sets = $this->Parameters->ParameterSets->find('list', ['limit' => 200]);
        $this->set(compact('parameter', 'sets'));
        $this->set('_serialize', ['parameter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parameter id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parameter = $this->Parameters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parameter = $this->Parameters->patchEntity($parameter, $this->request->getData());
            if ($this->Parameters->save($parameter)) {
                $this->Flash->success(__('The parameter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameter could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parameter'));
        $this->set('_serialize', ['parameter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parameter id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parameter = $this->Parameters->get($id);
        if ($this->Parameters->delete($parameter)) {
            $this->Flash->success(__('The parameter has been deleted.'));
        } else {
            $this->Flash->error(__('The parameter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
