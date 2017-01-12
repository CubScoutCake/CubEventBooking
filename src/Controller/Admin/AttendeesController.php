<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

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
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications.Scoutgroups', 'Applications.Events', 'Allergies']
            , 'order' => ['modified' => 'DESC']
        ];
        $this->set('attendees', $this->paginate($this->Attendees->find('countIncluded')));
        $this->set('_serialize', ['attendees']);
    }

    public function unattached()
    {
        $this->paginate = [
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications.Scoutgroups', 'Applications.Events', 'Allergies']
            , 'order' => ['modified' => 'DESC']
        ];
        $this->set('attendees', $this->paginate($this->Attendees->find('unattached')));
        $this->set('_serialize', ['attendees']);
    }
    /**
     * View method
     *
     * @param string|null $id Attendee id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendee = $this->Attendees->get($id, [
            'contain' => ['Users', 'Scoutgroups', 'Roles', 'Applications.Scoutgroups', 'Applications.Events', 'Allergies']
        ]);
        $this->set('attendee', $attendee);
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($userId = null)
    {
        $attendee = $this->Attendees->newEntity();
        if ($this->request->is('post')) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        if (is_null($userId)) {
            $users = $this->Attendees->Users->find('list', ['limit' => 200]);
            $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'order' => ['id' => 'DESC']]);
            $scoutgroups = $this->Attendees->Scoutgroups->find(
                'list',
                [
                    'keyField' => 'id',
                    'valueField' => 'scoutgroup',
                    'groupField' => 'district.district'
                ]
            )
                ->contain(['Districts']);
        } else {
            $usrs = TableRegistry::get('Users');

            $user = $usrs->get($userId);
            $grpId = $user->scoutgroup_id;


            $users = $this->Attendees->Users->find('list', ['limit' => 200, 'conditions' => ['id' => $userId]]);
            $applications = $this->Attendees->Applications->find('list', [
                'limit' => 200,
                'conditions' => [
                    'user_id' => $userId
                ],
                'order' => [
                    'id' => 'DESC'
                ]]);
            $scoutgroups = $this->Attendees->Scoutgroups->find('list', ['limit' => 200, 'conditions' => ['id' => $grpId]]);
        }

        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies', 'scoutgroups', 'roles'));
        $this->set('_serialize', ['attendee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendee id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attendee = $this->Attendees->get($id, [
            'contain' => ['Applications', 'Allergies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendee = $this->Attendees->patchEntity($attendee, $this->request->data);
            if ($this->Attendees->save($attendee)) {
                $this->Flash->success(__('The attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The attendee could not be saved. Please, try again.'));
            }
        }
        $users = $this->Attendees->Users->find('list', ['limit' => 200]);
        $applications = $this->Attendees->Applications->find('list', ['limit' => 200, 'conditions' => ['user_id' => $attendee->user_id]]);
        $allergies = $this->Attendees->Allergies->find('list', ['limit' => 200]);
        $scoutgroups = $this->Attendees->Scoutgroups->find(
            'list',
            [
                    'keyField' => 'id',
                    'valueField' => 'scoutgroup',
                    'groupField' => 'district.district'
            ]
        )
                ->contain(['Districts']);
        $roles = $this->Attendees->Roles->find('list', ['limit' => 200]);

        $this->set(compact('attendee', 'users', 'applications', 'allergies', 'scoutgroups', 'roles'));
        $this->set('_serialize', ['attendee']);
    }

    public function update($id = null)
    {
        $attendee = $this->Attendees->get($id);

        $upperAttendee = ['firstname' => ucwords(strtolower($attendee->firstname))
            , 'lastname' => ucwords(strtolower($attendee->lastname))
            , 'address_1' => ucwords(strtolower($attendee->address_1))
            , 'address_2' => ucwords(strtolower($attendee->address_2))
            , 'city' => ucwords(strtolower($attendee->city))
            , 'county' => ucwords(strtolower($attendee->county))
            , 'postcode' => strtoupper($attendee->postcode)];

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
     * @param string|null $id Attendee id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendee = $this->Attendees->get($id);
        if ($this->Attendees->delete($attendee)) {
            $this->Flash->success(__('The attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The attendee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
