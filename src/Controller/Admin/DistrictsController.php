<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * Districts Controller
 *
 * @property \App\Model\Table\DistrictsTable $Districts
 */
class DistrictsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set('districts', $this->paginate($this->Districts));
        $this->set('_serialize', ['districts']);
    }

    /**
     * View method
     *
     * @param string|null $districtId District id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($districtId = null)
    {
        $district = $this->Districts->get($districtId, [
            'contain' => [
                'Champions.Users',
                'Scoutgroups.Sections.Applications.Events',
                'Scoutgroups.Sections.Applications.Users',
            ],
        ]);
        $this->set('district', $district);
        $this->set('_serialize', ['district']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $district = $this->Districts->newEntity();
        if ($this->request->is('post')) {
            $district = $this->Districts->patchEntity($district, $this->request->getData());
            if ($this->Districts->save($district)) {
                $this->Flash->success(__('The district has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The district could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('district'));
        $this->set('_serialize', ['district']);
    }

    /**
     * Edit method
     *
     * @param string|null $districtId District id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($districtId = null)
    {
        $district = $this->Districts->get($districtId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $district = $this->Districts->patchEntity($district, $this->request->getData());
            if ($this->Districts->save($district)) {
                $this->Flash->success(__('The district has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The district could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('district'));
        $this->set('_serialize', ['district']);
    }

    /**
     * Delete method
     *
     * @param string|null $districtId District id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($districtId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $district = $this->Districts->get($districtId);
        if ($this->Districts->delete($district)) {
            $this->Flash->success(__('The district has been deleted.'));
        } else {
            $this->Flash->error(__('The district could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
