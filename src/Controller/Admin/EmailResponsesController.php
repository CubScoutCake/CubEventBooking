<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * EmailResponses Controller
 *
 * @property \App\Model\Table\EmailResponsesTable $EmailResponses
 */
class EmailResponsesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EmailSends', 'EmailResponseTypes'],
        ];
        $emailResponses = $this->paginate($this->EmailResponses);

        $this->set(compact('emailResponses'));
        $this->set('_serialize', ['emailResponses']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Response id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailResponse = $this->EmailResponses->get($id, [
            'contain' => ['EmailSends', 'EmailResponseTypes'],
        ]);

        $this->set('emailResponse', $emailResponse);
        $this->set('_serialize', ['emailResponse']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailResponse = $this->EmailResponses->newEntity();
        if ($this->request->is('post')) {
            $emailResponse = $this->EmailResponses->patchEntity($emailResponse, $this->request->getData());
            if ($this->EmailResponses->save($emailResponse)) {
                $this->Flash->success(__('The email response has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email response could not be saved. Please, try again.'));
        }
        $emailSends = $this->EmailResponses->EmailSends->find('list', ['limit' => 200]);
        $emailResponseTypes = $this->EmailResponses->EmailResponseTypes->find('list', ['limit' => 200]);
        $this->set(compact('emailResponse', 'emailSends', 'emailResponseTypes'));
        $this->set('_serialize', ['emailResponse']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Response id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailResponse = $this->EmailResponses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailResponse = $this->EmailResponses->patchEntity($emailResponse, $this->request->getData());
            if ($this->EmailResponses->save($emailResponse)) {
                $this->Flash->success(__('The email response has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email response could not be saved. Please, try again.'));
        }
        $emailSends = $this->EmailResponses->EmailSends->find('list', ['limit' => 200]);
        $emailResponseTypes = $this->EmailResponses->EmailResponseTypes->find('list', ['limit' => 200]);
        $this->set(compact('emailResponse', 'emailSends', 'emailResponseTypes'));
        $this->set('_serialize', ['emailResponse']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Response id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailResponse = $this->EmailResponses->get($id);
        if ($this->EmailResponses->delete($emailResponse)) {
            $this->Flash->success(__('The email response has been deleted.'));
        } else {
            $this->Flash->error(__('The email response could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
