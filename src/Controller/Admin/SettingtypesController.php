<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Settingtypes Controller
 *
 * @property \App\Model\Table\SettingtypesTable $Settingtypes
 */
class SettingtypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('settingtypes', $this->paginate($this->Settingtypes));
        $this->set('_serialize', ['settingtypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Settingtype id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $settingtype = $this->Settingtypes->get($id, [
            'contain' => ['Settings']
        ]);
        $this->set('settingtype', $settingtype);
        $this->set('_serialize', ['settingtype']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $settingtype = $this->Settingtypes->newEntity();
        if ($this->request->is('post')) {
            $settingtype = $this->Settingtypes->patchEntity($settingtype, $this->request->data);
            if ($this->Settingtypes->save($settingtype)) {
                $this->Flash->success(__('The settingtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The settingtype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('settingtype'));
        $this->set('_serialize', ['settingtype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Settingtype id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $settingtype = $this->Settingtypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settingtype = $this->Settingtypes->patchEntity($settingtype, $this->request->data);
            if ($this->Settingtypes->save($settingtype)) {
                $this->Flash->success(__('The settingtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The settingtype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('settingtype'));
        $this->set('_serialize', ['settingtype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Settingtype id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $settingtype = $this->Settingtypes->get($id);
        if ($this->Settingtypes->delete($settingtype)) {
            $this->Flash->success(__('The settingtype has been deleted.'));
        } else {
            $this->Flash->error(__('The settingtype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
