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
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $settingTypes = $this->paginate($this->SettingTypes);

        $this->set(compact('settingTypes'));
        $this->set('_serialize', ['settingTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Setting Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $settingType = $this->SettingTypes->newEntity();
        if ($this->request->is('post')) {
            $settingType = $this->SettingTypes->patchEntity($settingType, $this->request->data);
            if ($this->SettingTypes->save($settingType)) {
                $this->Flash->success(__('The setting type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setting type could not be saved. Please, try again.'));
        }
        $this->set(compact('settingType'));
        $this->set('_serialize', ['settingType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Setting Type id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
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
                $this->Flash->success(__('The setting type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setting type could not be saved. Please, try again.'));
        }
        $this->set(compact('settingType'));
        $this->set('_serialize', ['settingType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $settingType = $this->SettingTypes->get($id);
        if ($this->SettingTypes->delete($settingType)) {
            $this->Flash->success(__('The setting type has been deleted.'));
        } else {
            $this->Flash->error(__('The setting type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
