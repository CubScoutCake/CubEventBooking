<?php
namespace App\Controller\Parent;

use App\Model\Entity\Attendee;
use App\Model\Entity\User;
use Cake\Utility\Security;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function events()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users', 'Attendees', 'ReservationStatuses']
        ];
        $reservations = $this->paginate($this->Reservations);

        $this->set(compact('reservations'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => ['Events' => [
                'EventTypes' => [
                    'Payable',
                    'ApplicationRefs',
                    'LegalTexts',
                    ],
                'AdminUsers',
                ], 'Users', 'Attendees', 'ReservationStatuses', 'Invoices', 'LogisticItems']
        ]);

        $this->set('reservation', $reservation);
    }

    /**
     * Add method
     *
     * @param int|null $eventId The Event to be Reserved
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function reserve($eventId)
    {
        $reservation = $this->Reservations->newEntity();

        if (!is_null($eventId) && isset($eventId)) {
            $event = $this->Reservations->Events->get($eventId, ['contain' => [ 'Logistics', 'EventTypes', 'Prices']]);
            $reservation->set('event_id', $event->id);
        }

        if (!isset($event) || !$event->event_type->parent_applications) {
            return $this->redirect('/');
        }

        if ($this->request->is('post')) {
            // Set User & Attendee Data
            $requestData = $this->request->getData();
            $attendeeData = $requestData['attendee'];
            $userData = $requestData['user'];

            // Start Creating User
            /** @var \App\Model\Entity\User $user */
            $user = $this->Reservations->Users->detectExisting($userData);

            if ($user instanceof User) {
                $user = $this->Reservations->Users->get($user->id, ['contain' => 'AuthRoles']);

                $authArray = $user->auth_role->toArray();
                if (strpos('Parent', $authArray['auth_role'])) {
                    $authArray['auth_role'] = $authArray['auth_role'] . ' Parent';
                }
                if ($authArray['parent_access'] == false) {
                    $authArray['parent_access'] = true;
                }
                unset($authArray['auth_value']);

                /** @var \App\Model\Entity\AuthRole $authRole */
                $authRole = $this->Reservations->Users->AuthRoles->findOrCreate($authArray);
                $user->set('auth_role_id', $authRole->id);
                $this->Reservations->Users->save($user);
            }

            if ($user == false) {
                $userData['username'] = $userData['email'];
                $userData['password'] = Security::randomString(18);

                // AuthRole
                $authRole = $this->Reservations->Users->AuthRoles->find('all')->where(['auth' => 1])->firstOrFail();
                $userData['auth_role_id'] = $authRole->id;

                $userData['section_id'] = $attendeeData['section_id'];

                // Parent Role
                $parentRole = $this->Reservations->Users->Roles->findOrCreate([
                    'role' => 'Parent',
                    'invested' => false,
                    'minor' => false,
                    'automated' => false,
                    'short_role' => 'Parent',
                ]);
                $userData['role_id'] = $parentRole->id;

                $user = $this->Reservations->Users->newEntity($userData, ['validate' => 'parent']);
                $user = $this->Reservations->Users->save($user);
            }

            if ($user instanceof User) {
                $reservation->set('user_id', $user->id);
            }

            // Start Creating Attendee
            $attendeeData['user_id'] = $user->id;

            // Find Cub Role
            $cubRole = $this->Reservations->Users->Roles->findOrCreate([
                'role' => 'Cub Scout',
                'invested' => true,
                'minor' => true,
                'automated' => false,
                'short_role' => 'Cub',
            ]);
            $attendeeData['role_id'] = $cubRole->id;

            $attendee = $this->Reservations->Attendees->newEntity($attendeeData);
            /** @var \App\Model\Entity\Attendee $attendee */
            $attendee = $this->Reservations->Attendees->save($attendee);
            if ($attendee instanceof Attendee) {
                $reservation->set('attendee_id', $attendee->id);
            }

            // Reservation Status
            $reservationStatus = $this->Reservations->ReservationStatuses->findOrCreate([
                'reservation_status' => 'Pending Payment',
                'active' => true,
                'complete' => false
            ]);
            $reservation->set('reservation_status_id', $reservationStatus->id);

            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                $this->Auth->setUser($user->toArray());

                return $this->redirect(['action' => 'view', $reservation->id]);
            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }

        $events = $this->Reservations->Events->find('list', ['limit' => 200]);
        $sections = $this->Reservations->Attendees->Sections->find(
            'list',
            [
                'keyField' => 'id',
                'valueField' => function ($e) {
                    return $e->scoutgroup->scoutgroup . ' - ' . $e->section;
                },
                'groupField' => 'scoutgroup.district.district'
            ]
        )
//        ->where(['section_type_id' => $section['section_type_id']])
          ->contain(['Scoutgroups.Districts']);

        $this->set(compact('reservation', 'events', 'event', 'sections', 'attendees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }
        $events = $this->Reservations->Events->find('list', ['limit' => 200]);
        $users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $attendees = $this->Reservations->Attendees->find('list', ['limit' => 200]);
        $reservationStatuses = $this->Reservations->ReservationStatuses->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'events', 'users', 'attendees', 'reservationStatuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);
        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The reservation has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param \Cake\Event\Event $event The CakePHP emissive Event
     *
     * @return \Cake\Event\Event
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['reserve', 'events', 'confirmation']);

        return $event;
    }

    /**
     * @param \App\Model\Entity\User $user AuthUser Entity
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->getParam('action'), ['reserve'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->getParam('action'), ['edit', 'view'])) {
            $applicationId = $this->request->getParam('pass')[0];
            if ($this->Reservations->isOwnedBy($applicationId, $user['id'])) {
                return true;
            }

            return false;
        }

        return parent::isAuthorized($user);
    }
}
