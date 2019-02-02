<?php
namespace App\Controller\SuperUser;

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
     * @return \Cake\Http\Response|void
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
     * @param string|null $passwordStateId Password State id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($passwordStateId = null)
    {
        $passwordState = $this->PasswordStates->get($passwordStateId, [
            'contain' => ['Users']
        ]);

        $this->set('passwordState', $passwordState);
        $this->set('_serialize', ['passwordState']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passwordState = $this->PasswordStates->newEntity();
        if ($this->request->is('post')) {
            $passwordState = $this->PasswordStates->patchEntity($passwordState, $this->request->getData());
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
     * @param string|null $passwordStateId Password State id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($passwordStateId = null)
    {
        $passwordState = $this->PasswordStates->get($passwordStateId, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $passwordState = $this->PasswordStates->patchEntity($passwordState, $this->request->getData());
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
     * @param string|null $passwordStateId Password State id.
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($passwordStateId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $passwordState = $this->PasswordStates->get($passwordStateId);
        if ($this->PasswordStates->delete($passwordState)) {
            $this->Flash->success(__('The password state has been deleted.'));
        } else {
            $this->Flash->error(__('The password state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
