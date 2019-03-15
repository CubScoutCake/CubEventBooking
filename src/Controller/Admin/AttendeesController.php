<?php
namespace App\Controller\Admin;

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
            'contain' => [
                'Users',
                'Sections.Scoutgroups',
                'Roles',
                'Applications.Sections.Scoutgroups',
                'Applications.Events',
                'Allergies'
            ],
            'order' => ['modified' => 'DESC']
        ];
        if ($this->request->getParam('unattached')) {
            $this->set('attendees', $this->paginate($this->Attendees->find('unattached')));
        }

        $this->set('attendees', $this->paginate($this->Attendees->find('all')));
        $this->set('_serialize', ['attendees']);
    }

    /**
     * View method
     *
     * @param string|null $attendeeId Attendee id.
     *
     * @return void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($attendeeId = null)
    {
        $attendee = $this->Attendees->get($attendeeId, [
            'contain' => ['Users', 'Sections.Scoutgroups', 'Roles', 'Applications.Sections.Scoutgroups', 'Applications.Events', 'Allergies']
        ]);
        $this->set('attendee', $attendee);
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Add method
     *
     * @param int $userId The ID of the User
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->getData());
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));

                return $this->redirect(['action' => 'view', $attendee->id]);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        if (is_null($userId)) {
            $users = $this->Attendees->Users->find('list', ['limit' => 200]);
            $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'order' => ['id' => 'DESC']]);
            $sections = $this->Attendees->Sections->find(
                'list',
                [
                    'keyField' => 'id',
                    'valueField' => 'section',
                    'groupField' => 'scoutgroup.district.district'
                ]
            )
            ->contain(['Scoutgroups.Districts']);
        } else {
            $user = $this->Attendees->Users->get($userId);

            $users = $this->Attendees->Users->find('list', ['limit' => 200, 'conditions' => ['id' => $userId]]);
            $applications = $this->Attendees->Applications->find('list', [
                'limit' => 200,
                'conditions' => [
                    'user_id' => $userId
                ],
                'order' => [
                    'id' => 'DESC'
                ]]);
            $sections = $this->Attendees->Sections->find('list', ['limit' => 200, 'conditions' => ['id' => $user->section_id]]);
        }

        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies', 'sections', 'roles'));
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Call model removeDuplicate Function
     *
     * @param null $attendeeId The Attendee to be De-duplicated.
     *
     * @return \Cake\Http\Response|void
     */
    public function deduplicate($attendeeId = null)
    {
        $count = $this->Attendees->removeDuplicate($attendeeId);

        $this->Flash->success($count . ' Duplicate Attendees Merged.');

        return $this->redirect($this->referer(['controller' => 'Attendees', 'action' => 'view', $attendeeId]));
    }

    /**
     * Edit method
     *
     * @param string|null $attendeeId Attendee id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($attendeeId = null)
    {
        $attendee = $this->Attendees->get($attendeeId, [
            'contain' => ['Applications', 'Allergies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->getData());
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));

                return $this->redirect(['action' => 'view', $attendeeId]);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attendees->Users->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $attendee->user_id]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $sections = $this->Attendees->Sections->find(
            'list',
            [
                    'keyField' => 'id',
                    'valueField' => 'section',
                    'groupField' => 'scoutgroup.district.district'
            ]
        )
                ->contain(['Scoutgroups.Districts']);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies', 'sections', 'roles'));
        $this->set('_serialize', ['attendee']);
    }

    /**
     * @param null $attendeeId The Attendee to be Updated
     *
     * @return \Cake\Http\Response|null
     */
    public function update($attendeeId = null)
    {
        $attendee = $this->Attendees->get($attendeeId);

        $upperAttendee = [
            'firstname' => ucwords(strtolower($attendee->firstname)),
            'lastname' => ucwords(strtolower($attendee->lastname)),
            'address_1' => ucwords(strtolower($attendee->address_1)),
            'address_2' => ucwords(strtolower($attendee->address_2)),
            'city' => ucwords(strtolower($attendee->city)),
            'county' => ucwords(strtolower($attendee->county)),
            'postcode' => strtoupper($attendee->postcode),
        ];

        $attendee = $this->Attendees->patchEntity($attendee, $upperAttendee);

        $phone1 = $attendee->phone;
        $phone2 = $attendee->phone2;

        $phone1 = str_replace(' ', '', $phone1);
        $phone1 = str_replace('-', '', $phone1);
        $phone1 = str_replace('/', '', $phone1);
        $phone1 = substr($phone1, 0, 5) . ' ' . substr($phone1, 5);

        if (!empty($phone2)) {
            $phone2 = str_replace(' ', '', $phone2);
            $phone2 = str_replace('-', '', $phone2);
            $phone2 = str_replace('/', '', $phone2);
            $phone2 = substr($phone2, 0, 5) . ' ' . substr($phone2, 5);
        }

        $phoneAttendee = [
            'phone' => $phone1,
            'phone2' => $phone2
            ];

        $attendee = $this->Attendees->patchEntity($attendee, $phoneAttendee);

        if ($this->Attendees->save($attendee)) {
            $this->Flash->success(__('The attendee has been updated.'));

            return $this->redirect(['action' => 'view', $attendee->id]);
        } else {
            $this->Flash->error(__('The attendee could not be saved. Please, try again.'));

            return $this->redirect(['action' => 'view', $attendee->id]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $attendeeId Attendee id.
     *
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($attendeeId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendee = $this->Attendees->get($attendeeId);
        if ($this->Attendees->delete($attendee)) {
            $this->Flash->success(__('The attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The attendee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
