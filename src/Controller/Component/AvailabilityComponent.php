<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 10/01/2017
 * Time: 21:50
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Class ApplicationComponent
 * @package App\Controller\Component
 */
class AvailabilityComponent extends Component
{
    /**
     * Retrieve an Array of Numbers for the Number of Attendees.
     *
     * @param $applicationId
     * @return array
     */
    public function getNumbers($applicationId)
    {
        $this->Applications = TableRegistry::get('Applications');

        $Cubs = $this->Applications->find('cubs')->where(['Applications.id' => $applicationId])->count(['*']);
        $YLs = $this->Applications->find('youngLeaders')->where(['Applications.id' => $applicationId])->count(['*']);
        $Leaders = $this->Applications->find('leaders')->where(['Applications.id' => $applicationId])->count(['*']);

        $results = [
            'NumCubs' => $Cubs,
            'NumYLs' => $YLs,
            'NumLeaders' => $Leaders
        ];

        return $results;
    }
}
