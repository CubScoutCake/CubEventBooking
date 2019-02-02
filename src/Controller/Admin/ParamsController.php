<?php
namespace App\Controller\Admin;

/**
 * Params Controller
 *
 * @property \App\Model\Table\ParamsTable $Params
 */
class ParamsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parameters']
        ];
        $params = $this->paginate($this->Params);

        $this->set(compact('params'));
        $this->set('_serialize', ['params']);
    }

    /**
     * View method
     *
     * @param string|null $id Param id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $param = $this->Params->get($id, [
            'contain' => ['Parameters', 'LogisticItems']
        ]);

        $this->set('param', $param);
        $this->set('_serialize', ['param']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $param = $this->Params->newEntity();
        if ($this->request->is('post')) {
            $param = $this->Params->patchEntity($param, $this->request->getData());
            if ($this->Params->save($param)) {
                $this->Flash->success(__('The param has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The param could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->Params->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('param', 'parameters'));
        $this->set('_serialize', ['param']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Param id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $param = $this->Params->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $param = $this->Params->patchEntity($param, $this->request->getData());
            if ($this->Params->save($param)) {
                $this->Flash->success(__('The param has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The param could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->Params->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('param', 'parameters'));
        $this->set('_serialize', ['param']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Param id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $param = $this->Params->get($id);
        if ($this->Params->delete($param)) {
            $this->Flash->success(__('The param has been deleted.'));
        } else {
            $this->Flash->error(__('The param could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
