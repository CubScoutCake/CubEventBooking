<?php
namespace App\Controller\Component;

use App\Model\Entity\LogisticItem;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;

/**
 * Booking component
 *
 * @property \App\Model\Table\LogisticsTable $Logistics
 * @property \App\Model\Table\ReservationsTable $Reservations
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class BookingComponent extends Component
{

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
     * Function to load and deplete Logistic Limits
     *
     * @param int $logisticId ID of the Logistic in Question
     * @param int $paramId ID of the Param Selected
     *
     * @return null|bool
     */
    public function variableLogistic($logisticId, $paramId)
    {
        if (is_null($logisticId) || is_null($paramId)) {
            return false;
        }

        $this->Logistics = TableRegistry::getTableLocator()->get('Logistics');

        $this->Logistics->parseLogisticAvailability($logisticId);

        $logistic = $this->Logistics->get($logisticId, ['contain' => ['Parameters.Params']]);

        $maxVariable = $logistic->get('variable_max_values');

        if (!key_exists($paramId, $maxVariable)) {
            return false;
        }

        $variable = $maxVariable[$paramId];

        if ($variable['limit'] != 0 && $variable['remaining'] <= 0) {
            return false;
        }

        if ($variable['remaining'] >= 1) {
            return true;
        }
    }

    /**
     * Make a Session or Param Reservation
     *
     * @param int $reservationId The Reservation to be Attached
     * @param int $paramId The Param Selected
     *
     * @return bool|int|mixed
     */
    public function addReservation($reservationId, $paramId)
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
                $available = $this->variableLogistic($logistic->id, $param->id);

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
}
