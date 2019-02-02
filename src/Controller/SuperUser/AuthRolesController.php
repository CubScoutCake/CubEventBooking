<?php
namespace App\Controller\SuperUser;

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
     * @return \Cake\Http\Response|void
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
     * @param string|null $authRoleId Auth Role id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($authRoleId = null)
    {
        $authRole = $this->AuthRoles->get($authRoleId, [
            'contain' => ['Users']
        ]);

        $this->set('authRole', $authRole);
        $this->set('_serialize', ['authRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $authRole = $this->AuthRoles->newEntity();
        if ($this->request->is('post')) {
            $authRole = $this->AuthRoles->patchEntity($authRole, $this->request->getData());
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
     * @param string|null $authRoleId Auth Role id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($authRoleId = null)
    {
        $authRole = $this->AuthRoles->get($authRoleId, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $authRole = $this->AuthRoles->patchEntity($authRole, $this->request->getData());
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
     * @param string|null $authRoleId Auth Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($authRoleId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $authRole = $this->AuthRoles->get($authRoleId);
        if ($this->AuthRoles->delete($authRole)) {
            $this->Flash->success(__('The auth role has been deleted.'));
        } else {
            $this->Flash->error(__('The auth role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
