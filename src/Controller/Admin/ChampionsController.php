<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Champions Controller
 *
 * @property \App\Model\Table\ChampionsTable $Champions
 */
class ChampionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Districts','Users']
        ];
        $this->set('champions', $this->paginate($this->Champions));
        $this->set('_serialize', ['champions']);
    }

    /**
     * View method
     *
     * @param string|null $id Champion id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $champion = $this->Champions->get($id, [
            'contain' => ['Districts','Users']
        ]);
        $this->set('champion', $champion);
        $this->set('_serialize', ['champion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $champion = $this->Champions->newEntity();
        if ($this->request->is('post')) {
            $champion = $this->Champions->patchEntity($champion, $this->request->data);
            if ($this->Champions->save($champion)) {
                $this->Flash->success(__('The champion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The champion could not be saved. Please, try again.'));
            }
        }
        $districts = $this->Champions->Districts->find('list', ['limit' => 200]);
        $users = $this->Champions->Users->find('list', ['limit' => 200]);
        $this->set(compact('champion', 'districts', 'users'));
        $this->set('_serialize', ['champion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Champion id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $champion = $this->Champions->get($id, [
            'contain' => ['Users', 'Districts']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $champion = $this->Champions->patchEntity($champion, $this->request->data);
            if ($this->Champions->save($champion)) {
                $this->Flash->success(__('The champion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The champion could not be saved. Please, try again.'));
            }
        }
        $districts = $this->Champions->Districts->find('list', ['limit' => 200]);
        $users = $this->Champions->Users->find('list', ['limit' => 200]);
        $this->set(compact('champion', 'districts', 'users'));
        $this->set('_serialize', ['champion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Champion id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $champion = $this->Champions->get($id);
        if ($this->Champions->delete($champion)) {
            $this->Flash->success(__('The champion has been deleted.'));
        } else {
            $this->Flash->error(__('The champion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
