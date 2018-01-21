<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * NotificationTypes Controller
 *
 * @property \App\Model\Table\NotificationTypesTable $NotificationTypes
 */
class NotificationTypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('notificationTypes', $this->paginate($this->NotificationTypes));
        $this->set('_serialize', ['notification_types']);
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
        $notificationType = $this->NotificationTypes->get($id, [
            'contain' => ['Notifications']
        ]);
        $this->set('notificationType', $notificationType);
        $this->set('_serialize', ['notificationType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationtype = $this->NotificationTypes->newEntity();
        if ($this->request->is('post')) {
            $notificationtype = $this->NotificationTypes->patchEntity($notificationtype, $this->request->data);
            if ($this->NotificationTypes->save($notificationtype)) {
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
        $notificationtype = $this->NotificationTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationtype = $this->NotificationTypes->patchEntity($notificationtype, $this->request->data);
            if ($this->NotificationTypes->save($notificationtype)) {
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
        $notificationtype = $this->NotificationTypes->get($id);
        if ($this->NotificationTypes->delete($notificationtype)) {
            $this->Flash->success(__('The notificationtype has been deleted.'));
        } else {
            $this->Flash->error(__('The notificationtype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
