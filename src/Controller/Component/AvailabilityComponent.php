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
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @property \App\Model\Table\EventsTable $Events
 */
class AvailabilityComponent extends Component
{
    /**
     * Retrieve an Array of Numbers for the Number of Attendees.
     *
     * @param int $applicationId The application to be analysed
     * @return array
     */
    public function getNumbers($applicationId)
    {
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        /**
         * @var \App\Model\Entity\Application $application
         */
        $application = $this->Applications->get($applicationId, ['contain' => 'Events.SectionTypes.Roles']);
        $roleId = $application->event->section_type->role->id;

        $Section = $this->Applications->find('section', ['role_id' => $roleId])->where(['Applications.id' => $applicationId])->count();
        $NonSection = $this->Applications->find('nonSection', ['role_id' => $roleId])->where(['Applications.id' => $applicationId])->count();
        $Leaders = $this->Applications->find('leaders')->where(['Applications.id' => $applicationId])->count();

        $results = [
            'NumSection' => $Section,
            'NumNonSection' => $NonSection,
            'NumLeaders' => $Leaders
        ];

        return $results;
    }

    /**
     * Retrieve an Array of Numbers for the Number of Attendees.
     *
     * @param int $eventId The Event to be analysed
     * @return array
     */
    public function getEventNumbers($eventId)
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get($eventId, ['contain' => 'SectionTypes.Roles']);
        $roleId = $event->section_type->role->id;

        $Section = $this->Events->Applications->find('section', ['role_id' => $roleId])->where(['Applications.event_id' => $eventId])->count();
        $NonSection = $this->Events->Applications->find('nonSection', ['role_id' => $roleId])->where(['Applications.event_id' => $eventId])->count();
        $Leaders = $this->Events->Applications->find('leaders')->where(['Applications.event_id' => $eventId])->count();

        $results = [
            'NumSection' => $Section,
            'NumNonSection' => $NonSection,
            'NumLeaders' => $Leaders
        ];

        return $results;
    }
}
