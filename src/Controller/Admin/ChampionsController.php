<?php
declare(strict_types=1);

namespace App\Controller\Admin;

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
            'contain' => ['Districts', 'Users'],
        ];
        $this->set('champions', $this->paginate($this->Champions));
        $this->set('_serialize', ['champions']);
    }

    /**
     * View method
     *
     * @param string|null $championId Champion id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($championId = null)
    {
        $champion = $this->Champions->get($championId, [
            'contain' => ['Districts', 'Users'],
        ]);
        $this->set('champion', $champion);
        $this->set('_serialize', ['champion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $champion = $this->Champions->newEntity();
        if ($this->request->is('post')) {
            $champion = $this->Champions->patchEntity($champion, $this->request->getData());
            if ($this->Champions->save($champion)) {
                $redir = $champion->get('id');

                $this->Flash->success(__('The champion has been saved.'));

                return $this->redirect(['action' => 'view', $redir]);
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
     * @param string|null $championId Champion id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($championId = null)
    {
        $champion = $this->Champions->get($championId, [
            'contain' => ['Users', 'Districts'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $champion = $this->Champions->patchEntity($champion, $this->request->getData());
            if ($this->Champions->save($champion)) {
                $this->Flash->success(__('The champion has been saved.'));

                return $this->redirect(['action' => 'index', $champion->id]);
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
     * @param string|null $championId Champion id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($championId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $champion = $this->Champions->get($championId);
        if ($this->Champions->delete($champion)) {
            $this->Flash->success(__('The champion has been deleted.'));
        } else {
            $this->Flash->error(__('The champion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
