<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicationsAttendees Controller
 *
 * @property \App\Model\Table\ApplicationsAttendeesTable $ApplicationsAttendees
 */
class ApplicationsAttendeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Applications', 'Attendees']
        ];
        $applicationsAttendees = $this->paginate($this->ApplicationsAttendees);

        $this->set(compact('applicationsAttendees'));
        $this->set('_serialize', ['applicationsAttendees']);
    }

    /**
     * View method
     *
     * @param string|null $id Applications Attendee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicationsAttendee = $this->ApplicationsAttendees->get($id, [
            'contain' => ['Applications', 'Attendees']
        ]);

        $this->set('applicationsAttendee', $applicationsAttendee);
        $this->set('_serialize', ['applicationsAttendee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicationsAttendee = $this->ApplicationsAttendees->newEntity();
        if ($this->request->is('post')) {
            $applicationsAttendee = $this->ApplicationsAttendees->patchEntity($applicationsAttendee, $this->request->data);
            if ($this->ApplicationsAttendees->save($applicationsAttendee)) {
                $this->Flash->success(__('The applications attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applications attendee could not be saved. Please, try again.'));
            }
        }
        $applications = $this->ApplicationsAttendees->Applications->find('list', ['limit' => 200]);
        $attendees = $this->ApplicationsAttendees->Attendees->find('list', ['limit' => 200]);
        $this->set(compact('applicationsAttendee', 'applications', 'attendees'));
        $this->set('_serialize', ['applicationsAttendee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Applications Attendee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicationsAttendee = $this->ApplicationsAttendees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationsAttendee = $this->ApplicationsAttendees->patchEntity($applicationsAttendee, $this->request->data);
            if ($this->ApplicationsAttendees->save($applicationsAttendee)) {
                $this->Flash->success(__('The applications attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The applications attendee could not be saved. Please, try again.'));
            }
        }
        $applications = $this->ApplicationsAttendees->Applications->find('list', ['limit' => 200]);
        $attendees = $this->ApplicationsAttendees->Attendees->find('list', ['limit' => 200]);
        $this->set(compact('applicationsAttendee', 'applications', 'attendees'));
        $this->set('_serialize', ['applicationsAttendee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Applications Attendee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicationsAttendee = $this->ApplicationsAttendees->get($id);
        if ($this->ApplicationsAttendees->delete($applicationsAttendee)) {
            $this->Flash->success(__('The applications attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The applications attendee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
