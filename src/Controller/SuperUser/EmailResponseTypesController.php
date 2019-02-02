<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * EmailResponseTypes Controller
 *
 * @property \App\Model\Table\EmailResponseTypesTable $EmailResponseTypes
 */
class EmailResponseTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $emailResponseTypes = $this->paginate($this->EmailResponseTypes);

        $this->set(compact('emailResponseTypes'));
        $this->set('_serialize', ['emailResponseTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Response Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailResponseType = $this->EmailResponseTypes->get($id, [
            'contain' => ['EmailResponses']
        ]);

        $this->set('emailResponseType', $emailResponseType);
        $this->set('_serialize', ['emailResponseType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailResponseType = $this->EmailResponseTypes->newEntity();
        if ($this->request->is('post')) {
            $emailResponseType = $this->EmailResponseTypes->patchEntity($emailResponseType, $this->request->getData());
            if ($this->EmailResponseTypes->save($emailResponseType)) {
                $this->Flash->success(__('The email response type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email response type could not be saved. Please, try again.'));
        }
        $this->set(compact('emailResponseType'));
        $this->set('_serialize', ['emailResponseType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Response Type id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailResponseType = $this->EmailResponseTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailResponseType = $this->EmailResponseTypes->patchEntity($emailResponseType, $this->request->getData());
            if ($this->EmailResponseTypes->save($emailResponseType)) {
                $this->Flash->success(__('The email response type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email response type could not be saved. Please, try again.'));
        }
        $this->set(compact('emailResponseType'));
        $this->set('_serialize', ['emailResponseType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Response Type id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailResponseType = $this->EmailResponseTypes->get($id);
        if ($this->EmailResponseTypes->delete($emailResponseType)) {
            $this->Flash->success(__('The email response type has been deleted.'));
        } else {
            $this->Flash->error(__('The email response type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
