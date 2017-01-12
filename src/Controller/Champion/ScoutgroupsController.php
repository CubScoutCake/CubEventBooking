<?php
namespace App\Controller\Champion;

use App\Controller\Champion\AppController;
use Cake\ORM\TableRegistry;

/**
 * Scoutgroups Controller
 *
 * @property \App\Model\Table\ScoutgroupsTable $Scoutgroups
 */
class ScoutgroupsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $this->paginate = [
            'contain' => ['Districts'],
            'conditions' => ['district_id' => $champD->district_id]
        ];
        $this->set('scoutgroups', $this->paginate($this->Scoutgroups));
        $this->set('_serialize', ['scoutgroups']);
    }

    public function allIndex()
    {
        $this->paginate = [
            'contain' => ['Districts']
        ];
        $this->set('scoutgroups', $this->paginate($this->Scoutgroups));
        $this->set('_serialize', ['scoutgroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Scoutgroup id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $scoutgroup = $this->Scoutgroups->get($id, [
            'contain' => ['Districts', 'Applications', 'Attendees', 'Users']
        ]);
        $this->set('scoutgroup', $scoutgroup);
        $this->set('_serialize', ['scoutgroup']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $scoutgroups = TableRegistry::get('Scoutgroups');

        $champD = $scoutgroups->get($this->Auth->user('scoutgroup_id'));

        $district = ['district_id' => $champD->district_id];

        $scoutgroup = $this->Scoutgroups->newEntity();
        if ($this->request->is('post')) {
            $scoutgroup = $this->Scoutgroups->patchEntity($scoutgroup, $this->request->data);
            $scoutgroup = $this->Scoutgroups->patchEntity($scoutgroup, $district);
            if ($this->Scoutgroups->save($scoutgroup)) {
                $this->Flash->success(__('The scoutgroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scoutgroup could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('scoutgroup', 'districts'));
        $this->set('_serialize', ['scoutgroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Scoutgroup id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $scoutgroup = $this->Scoutgroups->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $scoutgroup = $this->Scoutgroups->patchEntity($scoutgroup, $this->request->data);
            if ($this->Scoutgroups->save($scoutgroup)) {
                $this->Flash->success(__('The scoutgroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scoutgroup could not be saved. Please, try again.'));
            }
        }
        $districts = $this->Scoutgroups->Districts->find('list', ['limit' => 200]);
        $this->set(compact('scoutgroup', 'districts'));
        $this->set('_serialize', ['scoutgroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Scoutgroup id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $scoutgroup = $this->Scoutgroups->get($id);
        if ($this->Scoutgroups->delete($scoutgroup)) {
            $this->Flash->success(__('The scoutgroup has been deleted.'));
        } else {
            $this->Flash->error(__('The scoutgroup could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
