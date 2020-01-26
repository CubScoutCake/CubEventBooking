<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Log\Log;
use Cake\ORM\Entity;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 * @property \App\Controller\Component\BookingComponent $Booking
 * @property \App\Model\Table\EmailSendsTable $EmailSends
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
    public function index()
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
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($reservationId = null)
    {
        $reservation = $this->Reservations->get($reservationId, [
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

        $complete = $this->Reservations->determinePaid($reservationId);
        $expired = $this->Reservations->determineExpired($reservationId);
        $cancelled = $this->Reservations->determineCancelled($reservationId);
        $expectedStatus = $this->Reservations->determineStatus($reservationId);
        $expectedStatus = $this->Reservations->ReservationStatuses->get($expectedStatus);
        $this->set(compact('complete', 'expired', 'cancelled', 'expectedStatus'));
    }

    /**
     * Add method
     *
     * @param int $eventId The ID of the Event
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     *
     * @throws \Exception
     */
    public function add($eventId)
    {
        $reservation = $this->Reservations->newEntity();

        if (!is_null($eventId) && isset($eventId)) {
            $event = $this->Reservations->Events->get($eventId, ['contain' => [ 'Logistics.Parameters.Params', 'EventTypes', 'Prices']]);
            $reservation->set('event_id', $event->id);
        }

//        $this->loadComponent('Availability');
        $this->loadComponent('Booking');

        if (!isset($event)) {
            return $this->redirect('/');
        }

        if ($this->request->is('post')) {
            $requestData = $this->request->getData();
            Log::info('Reservation Submitted.', $requestData);

            $bookingResponse = $this->Booking->addReservation($reservation, $eventId, $requestData, true, true);

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
     * @return \Cake\Http\Response Redirects on successful edit, renders view otherwise.
     */
    public function confirm($reservationId = null)
    {
        $this->loadModel('EmailSends');

        $response = $this->EmailSends->makeAndSend('RSV-' . $reservationId . '-VIE');

        if ($response) {
            $this->Flash->success('Email Sent');
        }

        return $this->redirect($this->referer(['controller' => 'Reservations', 'action' => 'view', $reservationId]));
    }

    /**
     * Edit method
     *
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($reservationId = null)
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
        $events = $this->Reservations->Events->find('list');
        $users = $this->Reservations->Users->find('list');
        $attendees = $this->Reservations->Attendees->find('list');
        $reservationStatuses = $this->Reservations->ReservationStatuses->find('list');
        $this->set(compact('reservation', 'events', 'users', 'attendees', 'reservationStatuses'));
    }

    /**
     * Extend method
     *
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function extend($reservationId = null)
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
        $this->set(compact('reservation'));
    }

    /**
     * Edit method
     *
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     *
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     * @throws \Exception
     */
    public function process($reservationId = null)
    {
        if ($this->request->is(['post']) && $this->request->getData('id')) {
            $this->redirect(['controller' => 'Reservations', 'action' => 'process', $this->request->getData('id')]);
        }

        if (!empty($reservationId)) {
            $reservation = $this->Reservations->get($reservationId, [
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
                    'Invoices.Payments',
                    'LogisticItems' => [
                        'Logistics',
                        'Params',
                    ],
                ],
            ]);
            if ($this->request->is(['patch', 'post', 'put']) && !$this->request->getData('id')) {
                $paymentData = $this->request->getData('invoice.payments.0');
                $payment = $this->Reservations->Invoices->Payments->newEntity($paymentData);
                $payment = $this->Reservations->Invoices->Payments->save($payment);
                $invoice = $this->Reservations->Invoices->get($reservation->invoice->id);

                $payment->_joinData = new Entity($paymentData['_joinData']);
                $return = $this->Reservations->Invoices->Payments->link($invoice, [$payment]);
                if ($return) {
                    $this->loadComponent('Booking');
                    $bookingResponse = $this->Booking->confirmReservation($reservation->id);

                    if ($bookingResponse) {
                        $this->Flash->success(__('The reservation has been saved.'));

                        return $this->redirect(['action' => 'view', $reservation->id]);
                    }
                }
                $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
            }

            $this->set(compact('reservation'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($reservationId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($reservationId);
        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The reservation has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Cancel method
     *
     * @param string|null $reservationId Reservation id.
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cancel($reservationId = null)
    {
        $this->request->allowMethod(['post']);

        if ($this->Reservations->cancel($reservationId)) {
            $this->Reservations->schedule($reservationId);
            $this->Flash->success(__('The reservation has been cancelled.'));
        } else {
            $this->Flash->error(__('The reservation could not be cancelled. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $reservationId]);
    }
}
