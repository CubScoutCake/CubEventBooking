<?php
namespace App\Controller;

/**
 * Attendees Controller
 *
 * @property \App\Model\Table\AttendeesTable $Attendees
 */
class AttendeesController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Sections.Scoutgroups', 'Roles'],
            'finder' => [
                'ownedBy' => [
                    'userId' => $this->Auth->user('id')
                ],
            ],
        ];
        $this->set('attendees', $this->paginate($this->Attendees));
        $this->set('_serialize', ['attendees']);
    }

    /**
     * View method
     *
     * @param string|null $attendeeID Attendee id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($attendeeID = null)
    {
        $attendee = $this->Attendees->get($attendeeID, [
            'contain' => ['Users', 'Sections.Scoutgroups', 'Roles', 'Applications.Sections.Scoutgroups', 'Applications.Events', 'Allergies']
        ]);
        $this->set('attendee', $attendee);
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Add method
     *
     * @param int $appId The ID of the Application to attach the Adult
     *
     * @return mixed - Redirects on successful add, renders view otherwise.
     */
    public function adult($appId = null)
    {
        $attendee = $this->Attendees->newEntity();

        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->getData());

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The Cub has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Cub could not be saved. Please, try again.'));
            }
        }

        $sections = $this->Attendees->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $roles = $this->Attendees->Roles->find('nonAuto')->find('adults')->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'sections', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->withData('application_id', $appId);
        }
    }

    /**
     * Create a Young Person
     *
     * @param null $appId The Application to add the Attendee to
     *
     * @return \Cake\Http\Response|null
     */
    public function cub($appId = null)
    {
        $attendee = $this->Attendees->newEntity();

        $attendee->set('user_id', $this->Auth->user('id'));

        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->getData());

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The Cub has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Cub could not be saved. Please, try again.'));
            }
        }

        $sections = $this->Attendees->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $this->Auth->user('section_id')]]);
        $roles = $this->Attendees->Roles->find('nonAuto')->find('minors')->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'sections', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);

        if ($this->request->is('get')) {
            // Values from the Model e.g.
            $this->request->withData('application_id', $appId);
        }
    }

    /**
     * Edit method
     *
     * @param int $attendeeId The ID of the Attendee.
     *
     * @return mixed Redirects on successful edit, renders view otherwise.
     *
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($attendeeId = null)
    {
        $attendee = $this->Attendees->get($attendeeId, [
            'contain' => ['Applications', 'Allergies', 'Users', 'Sections', 'Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->Attendees->patchEntity($attendee, $this->request->getData());

            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));

                return $this->redirect(['action' => 'view', $attendeeId]);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $sections = $this->Attendees->Sections->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('nonAuto')->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $this->Auth->user('id')]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'sections', 'roles', 'applications', 'allergies'));
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Delete method
     *
     * @param string|null $attendeeId Attendee id.
     *
     * @return \Cake\Http\Response Redirects to index.
     *
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($attendeeId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendee = $this->Attendees->get($attendeeId, ['contain' => ['Roles', 'Sections.Scoutgroups.Districts']]);
        if ($this->Attendees->delete($attendee)) {
            $this->Flash->success(__('The attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The attendee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param \App\Model\Entity\User $user The Logged in User
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['index', 'adult', 'cub'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->action, ['edit', 'view', 'delete'])) {
            $attendeeId = (int)$this->request->params['pass'][0];
            if ($this->Attendees->isOwnedBy($attendeeId, $user['id'])) {
                return true;
            } else {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }
}
