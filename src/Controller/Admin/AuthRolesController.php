<?php
declare(strict_types=1);

namespace App\Controller\Admin;

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
            'contain' => ['Users'],
        ]);

        $this->set('authRole', $authRole);
        $this->set('_serialize', ['authRole']);
    }
}
