<?php
declare(strict_types=1);

namespace App\Controller\SuperUser;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set('notificationTypes', $this->paginate($this->NotificationTypes));
        $this->set('_serialize', ['notification_types']);
    }

    /**
     * View method
     *
     * @param string|null $notificationTypeId Notification Type id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($notificationTypeId = null)
    {
        $notificationType = $this->NotificationTypes->get($notificationTypeId, [
            'contain' => ['Notifications'],
        ]);
        $this->set('notificationType', $notificationType);
        $this->set('_serialize', ['notificationType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notificationType = $this->NotificationTypes->newEntity();
        if ($this->request->is('post')) {
            $notificationType = $this->NotificationTypes->patchEntity($notificationType, $this->request->getData());
            if ($this->NotificationTypes->save($notificationType)) {
                $this->Flash->success(__('The notification_type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification_type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notificationType'));
        $this->set('_serialize', ['notification_type']);
    }

    /**
     * Edit method
     *
     * @param string|null $notificationTypeId Notification Type id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($notificationTypeId = null)
    {
        $notificationType = $this->NotificationTypes->get($notificationTypeId, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notificationType = $this->NotificationTypes->patchEntity($notificationType, $this->request->getData());
            if ($this->NotificationTypes->save($notificationType)) {
                $this->Flash->success(__('The notification_type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification_type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('notificationType'));
        $this->set('_serialize', ['notification_type']);
    }

    /**
     * Delete method
     *
     * @param string|null $notificationTypeId Notification Type id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($notificationTypeId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notificationType = $this->NotificationTypes->get($notificationTypeId);
        if ($this->NotificationTypes->delete($notificationType)) {
            $this->Flash->success(__('The notification_type has been deleted.'));
        } else {
            $this->Flash->error(__('The notification_type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
