<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Tokens Controller
 *
 * @property \App\Model\Table\TokensTable $Tokens
 */
class TokensController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'EmailSends']
        ];
        $tokens = $this->paginate($this->Tokens);

        $this->set(compact('tokens'));
        $this->set('_serialize', ['tokens']);
    }

    /**
     * View method
     *
     * @param string|null $id Token id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $token = $this->Tokens->get($id, [
            'contain' => ['Users', 'EmailSends']
        ]);

        $this->set('token', $token);
        $this->set('_serialize', ['token']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $token = $this->Tokens->newEntity();
        if ($this->request->is('post')) {
            $token = $this->Tokens->patchEntity($token, $this->request->data);
            if ($this->Tokens->save($token)) {
                $this->Flash->success(__('The token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The token could not be saved. Please, try again.'));
        }
        $users = $this->Tokens->Users->find('list', ['limit' => 200]);
        $emailSends = $this->Tokens->EmailSends->find('list', ['limit' => 200]);
        $this->set(compact('token', 'users', 'emailSends'));
        $this->set('_serialize', ['token']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Token id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $token = $this->Tokens->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $token = $this->Tokens->patchEntity($token, $this->request->data);
            if ($this->Tokens->save($token)) {
                $this->Flash->success(__('The token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The token could not be saved. Please, try again.'));
        }
        $users = $this->Tokens->Users->find('list', ['limit' => 200]);
        $emailSends = $this->Tokens->EmailSends->find('list', ['limit' => 200]);
        $this->set(compact('token', 'users', 'emailSends'));
        $this->set('_serialize', ['token']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Token id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $token = $this->Tokens->get($id);
        if ($this->Tokens->delete($token)) {
            $this->Flash->success(__('The token has been deleted.'));
        } else {
            $this->Flash->error(__('The token could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
