<?php
namespace App\Controller\SuperUser;

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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'NotificationTypes', 'Notifications']
        ];
        $emailSends = $this->paginate($this->EmailSends);

        $this->set(compact('emailSends'));
        $this->set('_serialize', ['emailSends']);
    }

    /**
     * View method
     *
     * @param string|null $emailSendId Email Send id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($emailSendId = null)
    {
        $emailSend = $this->EmailSends->get($emailSendId, [
            'contain' => ['Messages', 'Users', 'NotificationTypes', 'Notifications', 'EmailResponses', 'Tokens']
        ]);

        $this->set('emailSend', $emailSend);
        $this->set('_serialize', ['emailSend']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailSend = $this->EmailSends->newEntity();
        if ($this->request->is('post')) {
            $emailSend = $this->EmailSends->patchEntity($emailSend, $this->request->getData());
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
     * @param string|null $emailSendId Email Send id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($emailSendId = null)
    {
        $emailSend = $this->EmailSends->get($emailSendId, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailSend = $this->EmailSends->patchEntity($emailSend, $this->request->getData());
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
     * @param string|null $emailSendId Email Send id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($emailSendId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $emailSend = $this->EmailSends->get($emailSendId);
        if ($this->EmailSends->delete($emailSend)) {
            $this->Flash->success(__('The email send has been deleted.'));
        } else {
            $this->Flash->error(__('The email send could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
