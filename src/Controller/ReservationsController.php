<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users', 'Attendees', 'ReservationStatuses'],
        ];
        $this->set('reservations', $this->paginate(
            $this->Reservations->find('ownedBy', ['userId' => $this->Auth->user('id')])
        ));
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
        $this->viewBuilder()->setLayout('public');

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
    }

    /**
     * @param array $user AuthUser Entity
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->getParam('action'), ['index'])) {
            return true;
        }

        // The owner of an application can edit and delete it
        if (in_array($this->request->getParam('action'), ['view'])) {
            $reservationId = $this->request->getParam('pass')[0];
            if ($this->Reservations->isOwnedBy($reservationId, $user['id'])) {
                return true;
            }

            return false;
        }

        return parent::isAuthorized($user);
    }
}
