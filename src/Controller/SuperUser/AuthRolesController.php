<?php
namespace App\Controller\SuperUser;

use App\Controller\AppController;

/**
 * AuthRoles Controller
 *
 * @property \App\Model\Table\AuthRolesTable $AuthRoles
 */
class AuthRolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $authRoles = $this->paginate($this->AuthRoles);

        $this->set(compact('authRoles'));
        $this->set('_serialize', ['authRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id Auth Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $authRole = $this->AuthRoles->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('authRole', $authRole);
        $this->set('_serialize', ['authRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $authRole = $this->AuthRoles->newEntity();
        if ($this->request->is('post')) {
            $authRole = $this->AuthRoles->patchEntity($authRole, $this->request->data);
            if ($this->AuthRoles->save($authRole)) {
                $this->Flash->success(__('The auth role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The auth role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('authRole'));
        $this->set('_serialize', ['authRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Auth Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $authRole = $this->AuthRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $authRole = $this->AuthRoles->patchEntity($authRole, $this->request->data);
            if ($this->AuthRoles->save($authRole)) {
                $this->Flash->success(__('The auth role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The auth role could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('authRole'));
        $this->set('_serialize', ['authRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Auth Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $authRole = $this->AuthRoles->get($id);
        if ($this->AuthRoles->delete($authRole)) {
            $this->Flash->success(__('The auth role has been deleted.'));
        } else {
            $this->Flash->error(__('The auth role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
