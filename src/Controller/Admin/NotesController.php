<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applications', 'Invoices', 'Users']
            , 'order' => ['created' => 'DESC']
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
        $this->set('_serialize', ['notes']);
    }

    public function visible()
    {
        $this->paginate = [
            'contain' => ['Applications', 'Invoices', 'Users']
            , 'order' => ['created' => 'DESC']
            , 'conditions' => ['visible' => true]
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Applications', 'Invoices', 'Users']
        ]);

        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                $redir = $note->get('id');
                return $this->redirect(['action' => 'view', $redir]);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $applications = $this->Notes->Applications->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'display_code',
                'groupField' => 'event.name'
            ]
        )->contain('Events');
        $invoices = $this->Notes->Invoices->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'display_code',
                'groupField' => 'application.event.name'
            ]
        )->contain('Applications.Events');
        $users = $this->Notes->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $this->set(compact('note', 'applications', 'invoices', 'users'));
        $this->set('_serialize', ['note']);
    }

    public function newInvoice($invId)
    {
        if (!is_null($invId)) {
            $note = $this->Notes->newEntity();
            if ($this->request->is('post')) {
                $note = $this->Notes->patchEntity($note, $this->request->data);

                $invs = TableRegistry::get('Invoices');
                $invoice = $invs->get($invId);

                $invoiceLink = [
                    'invoice_id' => $invoice->id,
                    'user_id' => $invoice->user_id,
                    'application_id' => $invoice->application_id
                ];
                $note = $this->Notes->patchEntity($note, $invoiceLink);
                if ($this->Notes->save($note)) {
                    $this->Flash->success(__('The note has been saved.'));
                    return $this->redirect(['controller' => 'Invoices', 'action' => 'view', $invId]);
                } else {
                    $this->Flash->error(__('The note could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('note'));
            $this->set('_serialize', ['note']);
        } else {
            $this->Flash->error(__('No Invoice ID Specified.'));
            return $this->redirect(['controller' => 'Landing', 'action' => 'admin_home']);
        }
    }

    public function newApplication($appId)
    {
        if (!is_null($appId)) {
            $note = $this->Notes->newEntity();
            if ($this->request->is('post')) {
                $note = $this->Notes->patchEntity($note, $this->request->data);

                $apps = TableRegistry::get('Applications');
                $invs = TableRegistry::get('Invoices');

                $application = $apps->get($appId);
                $invFirst = $invs->find('all')->where(['application_id' => $appId])->first();

                $applicationLink = [
                    'application_id' => $application->id,
                    'invoice_id' => $invFirst->id,
                    'user_id' => $application->user_id
                ];
                $note = $this->Notes->patchEntity($note, $applicationLink);
                if ($this->Notes->save($note)) {
                    $this->Flash->success(__('The note has been saved.'));
                    return $this->redirect(['controller' => 'Applications', 'action' => 'view', $appId]);
                } else {
                    $this->Flash->error(__('The note could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('note'));
            $this->set('_serialize', ['note']);
        } else {
            $this->Flash->error(__('No Application ID Specified.'));
            return $this->redirect(['controller' => 'Landing', 'action' => 'admin_home']);
        }
    }

    public function newUser($userId)
    {
        if (!is_null($userId)) {
            $note = $this->Notes->newEntity();
            if ($this->request->is('post')) {
                $note = $this->Notes->patchEntity($note, $this->request->data);

                $userLink = ['user_id' => $userId];
                $note = $this->Notes->patchEntity($note, $userLink);
                if ($this->Notes->save($note)) {
                    $this->Flash->success(__('The note has been saved.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'view', $userId]);
                } else {
                    $this->Flash->error(__('The note could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('note'));
            $this->set('_serialize', ['note']);
        } else {
            $this->Flash->error(__('No User ID Specified.'));
            return $this->redirect(['controller' => 'Landing', 'action' => 'admin_home']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->data);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                $redir = $note->get('id');
                return $this->redirect(['action' => 'view', $redir]);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        $applications = $this->Notes->Applications->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'display_code',
                'groupField' => 'event.name'
            ]
        )->contain('Events');
        $invoices = $this->Notes->Invoices->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'display_code',
                'groupField' => 'application.event.name'
            ]
        )->contain('Applications.Events');
        $users = $this->Notes->Users->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => 'full_name',
                'groupField' => 'scoutgroup.district.district'
            ]
        )
            ->contain(['Scoutgroups.Districts']);
        $this->set(compact('note', 'applications', 'invoices', 'users'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
