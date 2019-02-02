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
     * @param string|null $id Notification Type id.
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
        $notification_type = $this->NotificationTypes->newEntity();
        if ($this->request->is('post')) {
            $notification_type = $this->NotificationTypes->patchEntity($notification_type, $this->request->data);
            if ($this->NotificationTypes->save($notification_type)) {
                $this->Flash->success(__('The notification_type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification_type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notification_type'));
        $this->set('_serialize', ['notification_type']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notification_type = $this->NotificationTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification_type = $this->NotificationTypes->patchEntity($notification_type, $this->request->data);
            if ($this->NotificationTypes->save($notification_type)) {
                $this->Flash->success(__('The notification_type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification_type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notification_type'));
        $this->set('_serialize', ['notification_type']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification_type = $this->NotificationTypes->get($id);
        if ($this->NotificationTypes->delete($notification_type)) {
            $this->Flash->success(__('The notification_type has been deleted.'));
        } else {
            $this->Flash->error(__('The notification_type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
