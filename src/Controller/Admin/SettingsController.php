<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'SettingTypes']
        ];
        $settings = $this->paginate($this->Settings);

        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }

    /**
     * View method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => ['Events', 'SettingTypes']
        ]);

        $this->set('setting', $setting);
        $this->set('_serialize', ['setting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $setting = $this->Settings->newEntity();
        if ($this->request->is('post')) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setting could not be saved. Please, try again.'));
        }
        $events = $this->Settings->Events->find('list', ['limit' => 200]);
        $settingTypes = $this->Settings->SettingTypes->find('list', ['limit' => 200]);
        $this->set(compact('setting', 'events', 'settingTypes'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setting could not be saved. Please, try again.'));
        }
        $events = $this->Settings->Events->find('list', ['limit' => 200]);
        $settingTypes = $this->Settings->SettingTypes->find('list', ['limit' => 200]);
        $this->set(compact('setting', 'events', 'settingTypes'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success(__('The setting has been deleted.'));
        } else {
            $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
