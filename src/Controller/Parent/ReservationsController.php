<?php
declare(strict_types=1);

namespace App\Controller\Parent;

use Cake\Log\Log;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @property \App\Controller\Component\LineComponent $Line
 * @property \App\Controller\Component\BookingComponent $Booking
 * @property \App\Controller\Component\AvailabilityComponent $Availability
 *
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings
 *     = [])
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
            'contain' => ['Events', 'Users', 'Attendees', 'ReservationStatuses'],
        ];
        $reservations = $this->paginate($this->Reservations);

        $this->set(compact('reservations'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     *
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
                    'Sections.Scoutgroups.Districts',
                ],
                'ReservationStatuses',
                'Invoices',
                'LogisticItems' => [
                    'Logistics',
                    'Params',
                ],
            ],
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

        if (! is_null($eventId) && isset($eventId)) {
            $event = $this->Reservations->Events->get($eventId, [
                'contain' => [
                    'Logistics.Parameters.Params',
                    'EventTypes',
                    'Prices',
                ],
            ]);
            $reservation->set('event_id', $event->id);
        }

//        $this->loadComponent('Availability');
        $this->loadComponent('Booking');

        if (! isset($event)) {
            return $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $requestData = $this->request->getData();
            Log::info('Reservation Submitted.', $requestData);

            $bookingResponse = $this->Booking->addReservation($reservation, $eventId, $requestData, true);

            if ($bookingResponse) {
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
                'groupField' => 'scoutgroup.district.district',
            ]
        )
            ->where(['section_type_id' => $event->section_type_id])
            ->contain(['Scoutgroups.Districts']);

        $sessions = $this->Reservations->Events->Logistics->Parameters->Params->find('list');

        $this->set(compact('reservation', 'events', 'event', 'sections', 'sessions'));
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
            'contain' => [],
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
