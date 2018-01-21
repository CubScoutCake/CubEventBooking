<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * PasswordStates Controller
 *
 * @property \App\Model\Table\PasswordStatesTable $PasswordStates
 */
class PasswordStatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $passwordStates = $this->paginate($this->PasswordStates);

        $this->set(compact('passwordStates'));
        $this->set('_serialize', ['passwordStates']);
    }

    /**
     * View method
     *
     * @param string|null $id Password State id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $passwordState = $this->PasswordStates->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('passwordState', $passwordState);
        $this->set('_serialize', ['passwordState']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passwordState = $this->PasswordStates->newEntity();
        if ($this->request->is('post')) {
            $passwordState = $this->PasswordStates->patchEntity($passwordState, $this->request->data);
            if ($this->PasswordStates->save($passwordState)) {
                $this->Flash->success(__('The password state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password state could not be saved. Please, try again.'));
        }
        $this->set(compact('passwordState'));
        $this->set('_serialize', ['passwordState']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Password State id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $passwordState = $this->PasswordStates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $passwordState = $this->PasswordStates->patchEntity($passwordState, $this->request->data);
            if ($this->PasswordStates->save($passwordState)) {
                $this->Flash->success(__('The password state has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password state could not be saved. Please, try again.'));
        }
        $this->set(compact('passwordState'));
        $this->set('_serialize', ['passwordState']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Password State id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $passwordState = $this->PasswordStates->get($id);
        if ($this->PasswordStates->delete($passwordState)) {
            $this->Flash->success(__('The password state has been deleted.'));
        } else {
            $this->Flash->error(__('The password state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
