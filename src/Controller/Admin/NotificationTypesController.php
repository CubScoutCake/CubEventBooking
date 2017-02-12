<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

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
        $this->set('NotificationTypes', $this->paginate($this->NotificationTypes));
        $this->set('_serialize', ['NotificationTypes']);
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
        $notificationtype = $this->NotificationTypes->get($id, [
            'contain' => ['Notifications']
        ]);
        $this->set('notification_type', $notificationType);
        $this->set('_serialize', ['notification_type']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationType = $this->NotificationTypes->newEntity();
        if ($this->request->is('post')) {
            $notificationType = $this->NotificationTypes->patchEntity($notificationType, $this->request->data);
            if ($this->NotificationTypes->save($notificationType)) {
                $this->Flash->success(__('The notification type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notification_type'));
        $this->set('_serialize', ['notification_type']);
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
        $notificationType = $this->NotificationTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationType = $this->NotificationTypes->patchEntity($notificationType, $this->request->data);
            if ($this->NotificationTypes->save($notificationType)) {
                $this->Flash->success(__('The notification type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notification_type'));
        $this->set('_serialize', ['notification_type']);
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
        $notificationType = $this->NotificationTypes->get($id);
        if ($this->NotificationTypes->delete($notificationType)) {
            $this->Flash->success(__('The notification_type has been deleted.'));
        } else {
            $this->Flash->error(__('The notification_type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
