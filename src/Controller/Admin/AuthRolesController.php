<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

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
}
