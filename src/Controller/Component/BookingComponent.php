<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;

/**
 * Booking component
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
}
