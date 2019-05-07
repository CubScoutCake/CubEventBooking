<?php
namespace App\Controller\Component;

use App\Model\Entity\Attendee;
use App\Model\Entity\LogisticItem;
use App\Model\Entity\User;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Booking component
 *
 * @property \App\Model\Table\LogisticsTable $Logistics
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @property \App\Controller\Component\AvailabilityComponent Availability
 * @property \Cake\Controller\Component\FlashComponent $Flash
 * @property \App\Controller\Component\LineComponent $Line
 * @property \Cake\Controller\Component\AuthComponent $Auth
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class BookingComponent extends Component
{
    public $components = ['Availability', 'Flash', 'Line', 'Auth'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param string $dateOfBirth The Date of Birth of to be guessed.
     * @param bool $leaderPatrol The Leader Patrol
     *
     * @return int|bool
     */
    public function guessRole($dateOfBirth, $leaderPatrol = null)
    {
        $sectionTypesTable = TableRegistry::get('SectionTypes');

        $leaderSecType = $sectionTypesTable->find('all')->where(['lower_age' => 18])->first();
        $leaderRole = $leaderSecType->role_id;

        if (!isset($dateOfBirth) || !preg_match('/[0-9]+-[0-9]+-[0-9]+/', $dateOfBirth)) {
            if (is_null($leaderPatrol) || !$leaderPatrol) {
                return false;
            }
            if (!is_null($leaderPatrol) && $leaderPatrol) {
                return $leaderRole;
            }
        }

        $sectionTypes = $sectionTypesTable
            ->find('all')
            ->orderDesc('upper_age')
            ->toArray();

        $dob = new Date($dateOfBirth);

        $now = Date::now();
        $ageArr = date_diff($dob, $now);
        $age = $ageArr->y;

        $currentProb = 0;

        foreach ($sectionTypes as $sectionType) {
            $upper = $sectionType->upper_age;
            if ($upper == 10) {
                $upper = 10.5;
            }

            $lower = $sectionType->lower_age;
            if ($lower == 10) {
                $lower = 10.5;
            }

            $total = $upper + $lower;
            $avg = $total / 2;

            $lowerProb = 0;
            $upperProb = 0;
            $lowerMonthProb = 1;
            $upperMonthProb = 1;
            $diffProb = 1;

            $diff = abs($age - $avg);
            if ($diff <> 0 && !is_null($diff)) {
                $diffProb = 1 / $diff;
            }

            if ($age >= ( $lower - 1)) {
                $lowerProb = 1;
            }

            if ($age == $lower) {
                if ($ageArr->m == 0) {
                    $lowerMonthProb = 1;
                } else {
                    $lowerMonthProb = 12 / $ageArr->m;
                }
            }

            if ($age <= ( $upper + 1)) {
                $upperProb = 1;
            }

            if ($age == $upper) {
                if ($ageArr->m == 0) {
                    $upperMonthProb = 0;
                } elseif ((12 / $ageArr->m) == 0) {
                    $upperMonthProb = 1;
                } else {
                    $upperMonthProb = 1 / (12 / $ageArr->m);
                }
            }

            $prob = ($diffProb + (( $lowerProb + $lowerMonthProb ) / 2) + (($upperProb + $upperMonthProb) / 2)) / 3;

            if ($prob > $currentProb) {
                $currentProb = $prob;
                $guessID = $sectionType->role_id;
            }
        }

        if (isset($guessID)) {
            return $guessID;
        }

        return false;
    }

    /**
     * Make a Session or Param Reservation
     *
     * @param int $reservationId The Reservation to be Attached
     * @param int $paramId The Param Selected
     *
     * @return bool|int|mixed
     */
    private function addResLogistic($reservationId, $paramId)
    {
        if (is_null($reservationId) || is_null($paramId)) {
            return false;
        }

        $this->Reservations = TableRegistry::getTableLocator()->get('Reservations');
        /** @var \App\Model\Entity\Param $param */
        $param = $this->Reservations->LogisticItems->Params->get($paramId);
        /** @var \App\Model\Entity\Reservation $reservation */
        $reservation = $this->Reservations->get($reservationId, ['contain' => 'Events.Logistics']);

        foreach ($reservation->event->logistics as $logistic) {
            if ($logistic->parameter_id == $param->parameter_id) {
                $available = $this->Availability->checkVariableLogistic($logistic->id, $param->id);

                if ($available) {
                    // Create & Save new Logistic Item
                    /** @var \App\Model\Entity\LogisticItem $logisticItem */
                    $logisticItem = $this->Reservations->LogisticItems->newEntity([
                        'reservation_id' => $reservation->id,
                        'logistic_id' => $logistic->id,
                        'param_id' => $paramId,
                    ]);

                    $logisticItem = $this->Reservations->LogisticItems->save($logisticItem);

                    if ($logisticItem != false) {
                        return $logisticItem->id;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Make a Session or Param Reservation
     *
     * @param \App\Model\Entity\Reservation $reservation The Reservation to be Attached
     * @param int $eventId The Event Selected
     * @param array $requestData The Data from the Request
     * @param bool $flash Should Flash Messages be emitted
     *
     * @return bool|int|mixed
     */
    public function addReservation($reservation, $eventId, $requestData, $flash = false)
    {
        $this->Reservations = TableRegistry::getTableLocator()->get('Reservations');

        if (!$this->Availability->checkReservation($eventId, $flash)) {
            if ($flash) {
                $this->Flash->error('Spaces not available on Event');
            }

            return false;
        }

        $reservation->set('event_id', $eventId);

        $attendeeData = $requestData['attendee'];
        $userData = $requestData['user'];

        if (!is_array($userData) || !is_array($attendeeData)) {
            return false;
        }

        $doLogistics = false;
        if (isset($requestData['logistics_item'])) {
            if (is_array($requestData['logistics_item']) && !empty($requestData['logistics_item'])) {
                $doLogistics = true;
                $logisticData = $requestData['logistics_item'];

                foreach ($logisticData as $logisticDatum) {
                    if (!$this->Availability->checkVariableLogistic($logisticDatum['logistic_id'], $logisticDatum['param_id'])) {
                        if ($flash) {
                            $this->Flash->error('Spaces not available on Session.');
                        }

                        return false;
                    }
                }
            }
        }

        // Find or Create User
        /** @var \App\Model\Entity\User $user */
        $user = $this->Reservations->Users->createOrDetectParent($userData, $attendeeData['section_id']);
        $reservation->set('user_id', $user->id);
        if ($user == false) {
            if ($flash) {
                $this->Flash->error('There was an Error Creating your User');
            }

            return false;
        }

        // Find or Create Attendee
        /** @var \App\Model\Entity\Attendee $attendee */
        $attendee = $this->Reservations->Attendees->createReservationAttendee($attendeeData, $user->id);
        $reservation->set('attendee_id', $attendee->id);
        if ($attendee == false) {
            if ($flash) {
                $this->Flash->error('There was an Error Creating your Attendee');
            }

            return false;
        }

        // Reservation Status
        $reservationStatus = $this->Reservations->ReservationStatuses->findOrCreate([
            'reservation_status' => 'Pending Payment',
            'active' => true,
            'complete' => false
        ]);
        $reservation->set('reservation_status_id', $reservationStatus->id);

        if ($this->Reservations->save($reservation)) {
            // Create Invoice
            $this->Line->parseReservation($reservation->id);

            if ($doLogistics && isset($logisticData)) {
                foreach ($logisticData as $logisticDatum) {
                    $result = $this->addResLogistic($reservation->id, $logisticDatum['param_id']);
                    if (!$result) {
                        if ($flash) {
                            $this->Flash->error('There was an Adding you to the Session');
                        }

                        return false;
                    }
                }
            }

            if ($flash) {
                $this->Flash->success(__('The reservation has been saved.'));

                $this->Auth->setUser($user->toArray());
            }

            return true;
        }
    }
}
