<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * SettingTypes Controller
 *
 * @property \App\Model\Table\SettingTypesTable $SettingTypes
 */
class SettingTypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('settingTypes', $this->paginate($this->SettingTypes));
        $this->set('_serialize', ['settingTypes']);
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
        $settingType = $this->SettingTypes->get($id, [
            'contain' => ['Settings']
        ]);
        $this->set('settingType', $settingType);
        $this->set('_serialize', ['settingType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $settingType = $this->SettingTypes->newEntity();
        if ($this->request->is('post')) {
            $settingType = $this->SettingTypes->patchEntity($settingType, $this->request->data);
            if ($this->SettingTypes->save($settingType)) {
                $this->Flash->success(__('The settingType has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The settingType could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('settingType'));
        $this->set('_serialize', ['settingType']);
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
        $settingType = $this->SettingTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settingType = $this->SettingTypes->patchEntity($settingType, $this->request->data);
            if ($this->SettingTypes->save($settingType)) {
                $this->Flash->success(__('The settingType has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The settingType could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('settingType'));
        $this->set('_serialize', ['settingType']);
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
        $settingType = $this->SettingTypes->get($id);
        if ($this->SettingTypes->delete($settingType)) {
            $this->Flash->success(__('The settingType has been deleted.'));
        } else {
            $this->Flash->error(__('The settingType could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
