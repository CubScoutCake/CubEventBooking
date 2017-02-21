<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * EmailSends Controller
 *
 * @property \App\Model\Table\EmailSendsTable $EmailSends
 */
class EmailSendsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Messages', 'Users', 'NotificationTypes', 'Notifications']
        ];
        $emailSends = $this->paginate($this->EmailSends);

        $this->set(compact('emailSends'));
        $this->set('_serialize', ['emailSends']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Send id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailSend = $this->EmailSends->get($id, [
            'contain' => ['Messages', 'Users', 'NotificationTypes', 'Notifications', 'EmailResponses', 'Tokens']
        ]);

        $this->set('emailSend', $emailSend);
        $this->set('_serialize', ['emailSend']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailSend = $this->EmailSends->newEntity();
        if ($this->request->is('post')) {
            $emailSend = $this->EmailSends->patchEntity($emailSend, $this->request->data);
            if ($this->EmailSends->save($emailSend)) {
                $this->Flash->success(__('The email send has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email send could not be saved. Please, try again.'));
        }
        $messages = $this->EmailSends->Messages->find('list', ['limit' => 200]);
        $users = $this->EmailSends->Users->find('list', ['limit' => 200]);
        $notificationTypes = $this->EmailSends->NotificationTypes->find('list', ['limit' => 200]);
        $notifications = $this->EmailSends->Notifications->find('list', ['limit' => 200]);
        $this->set(compact('emailSend', 'messages', 'users', 'notificationTypes', 'notifications'));
        $this->set('_serialize', ['emailSend']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Send id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailSend = $this->EmailSends->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailSend = $this->EmailSends->patchEntity($emailSend, $this->request->data);
            if ($this->EmailSends->save($emailSend)) {
                $this->Flash->success(__('The email send has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email send could not be saved. Please, try again.'));
        }
        $messages = $this->EmailSends->Messages->find('list', ['limit' => 200]);
        $users = $this->EmailSends->Users->find('list', ['limit' => 200]);
        $notificationTypes = $this->EmailSends->NotificationTypes->find('list', ['limit' => 200]);
        $notifications = $this->EmailSends->Notifications->find('list', ['limit' => 200]);
        $this->set(compact('emailSend', 'messages', 'users', 'notificationTypes', 'notifications'));
        $this->set('_serialize', ['emailSend']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Send id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailSend = $this->EmailSends->get($id);
        if ($this->EmailSends->delete($emailSend)) {
            $this->Flash->success(__('The email send has been deleted.'));
        } else {
            $this->Flash->error(__('The email send could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
