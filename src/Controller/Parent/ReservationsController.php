<?php
namespace App\Controller\Parent;

use App\Model\Entity\Attendee;
use App\Model\Entity\User;
use Cake\Log\Log;
use Cake\Utility\Security;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @property \App\Controller\Component\LineComponent $Line
 * @property \App\Controller\Component\BookingComponent $Booking
 * @property \App\Controller\Component\AvailabilityComponent $Availability
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
            'contain' => [
                'Events' => [
                    'EventTypes' => [
                        'Payable',
                        'ApplicationRefs',
                        'LegalTexts',
                    ],
                    'AdminUsers',
                ],
                'Users',
                'Attendees' => [
                    'Sections.Scoutgroups.Districts'
                ],
                'ReservationStatuses',
                'Invoices',
                'LogisticItems' => [
                    'Logistics',
                    'Params',
                ]
            ]
        ]);

        $this->set('reservation', $reservation);
    }

    /**
     * Add method
     *
     * @param int|null $eventId The Event to be Reserved
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     *
     * @throws \Exception
     */
    public function reserve($eventId)
    {
        $reservation = $this->Reservations->newEntity();

        if (!is_null($eventId) && isset($eventId)) {
            $event = $this->Reservations->Events->get($eventId, ['contain' => [ 'Logistics.Parameters.Params', 'EventTypes', 'Prices']]);
            $reservation->set('event_id', $event->id);
        }

        $this->loadComponent('Availability');
        $this->loadComponent('Booking');

        if (!isset($event)) {
            return $this->redirect('/');
        }

        if ($this->request->is('post') && $this->Availability->checkReservation($eventId, true)) {
            // Set User & Attendee Data
            $requestData = $this->request->getData();
            Log::info('Reservation Submitted.', $requestData);

            $attendeeData = $requestData['attendee'];
            $userData = $requestData['user'];
            if (is_array($requestData['logistics_item'])) {
                $logisticData = $requestData['logistics_item'];

                foreach ($logisticData as $logisticDatum) {
                    if (!$this->Booking->variableLogistic($logisticDatum['logistic_id'], $logisticDatum['param_id'])) {
                        $this->Flash->error('Spaces not available on Session');

                        return $this->redirect($this->referer());
                    }
                }
            }

            // Start Creating User
            /** @var \App\Model\Entity\User $user */
            $user = $this->Reservations->Users->detectExisting($userData);

            if ($user instanceof User) {
                $userId = $user->id;
                $user = $this->Reservations->Users->get($userId, ['contain' => 'AuthRoles']);

                if (!$user->auth_role->parent) {
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
                // Check overall availability
                $this->loadComponent('Line');
                $this->Line->parseReservation($reservation->id);

                if (isset($logisticData)) {
                    foreach ($logisticData as $logisticDatum) {
                        $this->Booking->addReservation($reservation->id, $logisticDatum['param_id']);
                    }
                }

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

        $sessions = $this->Reservations->Events->Logistics->Parameters->Params->find('list');

        $this->set(compact('reservation', 'events', 'event', 'sections', 'attendees', 'sessions'));
    }

    /**
     * Edit method
     *
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cancel($reservationId = null)
    {
        $reservation = $this->Reservations->get($reservationId, [
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
     * @param \Cake\Event\Event $event The CakePHP emissive Event
     *
     * @return \Cake\Event\Event
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(['reserve', 'events']);

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
        if (in_array($this->request->getParam('action'), ['cancel', 'view'])) {
            $reservationId = $this->request->getParam('pass')[0];
            if ($this->Reservations->isOwnedBy($reservationId, $user['id'])) {
                return true;
            }

            return false;
        }

        return parent::isAuthorized($user);
    }
}
