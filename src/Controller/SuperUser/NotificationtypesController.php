<?php
namespace App\Controller\SuperUser;

use App\Controller\Admin\AppController;

/**
 * Notificationtypes Controller
 *
 * @property \App\Model\Table\NotificationtypesTable $Notificationtypes
 */
class NotificationtypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('notificationtypes', $this->paginate($this->Notificationtypes));
        $this->set('_serialize', ['notificationtypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Notificationtype id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notificationtype = $this->Notificationtypes->get($id, [
            'contain' => ['Notifications']
        ]);
        $this->set('notificationtype', $notificationtype);
        $this->set('_serialize', ['notificationtype']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationtype = $this->Notificationtypes->newEntity();
        if ($this->request->is('post')) {
            $notificationtype = $this->Notificationtypes->patchEntity($notificationtype, $this->request->data);
            if ($this->Notificationtypes->save($notificationtype)) {
                $this->Flash->success(__('The notificationtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notificationtype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notificationtype'));
        $this->set('_serialize', ['notificationtype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notificationtype id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notificationtype = $this->Notificationtypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationtype = $this->Notificationtypes->patchEntity($notificationtype, $this->request->data);
            if ($this->Notificationtypes->save($notificationtype)) {
                $this->Flash->success(__('The notificationtype has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notificationtype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notificationtype'));
        $this->set('_serialize', ['notificationtype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notificationtype id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificationtype = $this->Notificationtypes->get($id);
        if ($this->Notificationtypes->delete($notificationtype)) {
            $this->Flash->success(__('The notificationtype has been deleted.'));
        } else {
            $this->Flash->error(__('The notificationtype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
