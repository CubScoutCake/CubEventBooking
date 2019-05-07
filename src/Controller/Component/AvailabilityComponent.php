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
use Cake\Utility\Inflector;

/**
 * Class ApplicationComponent
 * @package App\Controller\Component
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @property \App\Model\Table\ReservationsTable $Reservations
 * @property \App\Model\Table\LogisticsTable $Logistics
 * @property \App\Model\Table\InvoicesTable $Invoices
 * @property \App\Model\Table\EventsTable $Events
 *
 * @property \Cake\Controller\Component\FlashComponent $Flash
 */
class AvailabilityComponent extends Component
{
    public $components = ['Flash'];

    /**
     * Reserved Numbers
     *
     * @param \App\Model\Entity\Application $application The Application including ApplicationStatus
     *
     * @return array|bool
     */
    private function getReservedNumbers($application)
    {
        $numTerms = ['Section', 'NonSection', 'Leaders'];

        if ($application->application_status->reserved) {
            if (key_exists('section', $application->hold_numbers)) {
                foreach ($application->hold_numbers as $key => $value) {
                    $newKey = Inflector::camelize($key);
                    if (in_array($newKey, $numTerms)) {
                        $newKey = 'Num' . $newKey;
                    }
                    $results[$newKey] = $value;
                }
                $results['NumTeams'] = 1;
                $results['Reserved'] = true;

                return $results;
            }
        }

        return false;
    }

    /**
     * Retrieve an Array of Numbers for the Number of Attendees.
     *
     * @param int $applicationId The application to be analysed
     * @return array
     */
    public function getApplicationNumbers($applicationId)
    {
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        /** @var \App\Model\Entity\Application $application */
        $application = $this->Applications->get($applicationId, ['contain' => [ 'Events.SectionTypes.Roles', 'ApplicationStatuses']]);

        if (is_array($results = $this->getReservedNumbers($application))) {
            return $results;
        }

        $roleId = $application->event->section_type->role->id;

        $section = $this->Applications->find('section', ['role_id' => $roleId])->where(['Applications.id' => $applicationId])->count();
        $nonSection = $this->Applications->find('nonSection', ['role_id' => $roleId])->where(['Applications.id' => $applicationId])->count();
        $leaders = $this->Applications->find('leaders')->where(['Applications.id' => $applicationId])->count();

        $results = [
            'NumSection' => $section,
            'NumNonSection' => $nonSection,
            'NumLeaders' => $leaders,
            'NumTeams' => 1,
        ];

        return $results;
    }

    /**
     * Get all of the Numbers for an Event
     *
     * @param int $eventId The ID of the Event
     *
     * @return array
     */
    public function getEventApplicationNumbers($eventId)
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get($eventId, ['contain' => 'Applications']);

        $results = [
            'NumSection' => 0,
            'NumNonSection' => 0,
            'NumLeaders' => 0,
            'NumTeams' => 0,
        ];

        foreach ($event->applications as $application) {
            $appResults = $this->getApplicationNumbers($application->id);

            foreach ($appResults as $appResult => $value) {
                $results[$appResult] += $value;
            }
        }

        return $results;
    }

    /**
     * function to get Invoice Numbers
     *
     * @param int $invoiceID the Invoice to be analysed
     *
     * @return array
     */
    public function getInvoiceNumbers($invoiceID)
    {
        $this->Invoices = TableRegistry::getTableLocator()->get('Invoices');

        $invSection = 0;
        $invNonSection = 0;
        $invLeaders = 0;

        $invoice = $this->Invoices->get($invoiceID, ['contain' => 'Applications.Events.SectionTypes']);
        $appID = $invoice->application->id;

        $invSectionCount = $this->Invoices->InvoiceItems->find('minors', ['application_id' => $appID, 'role_id' => $invoice->application->event->section_type->role_id])->count();

        if ($invSectionCount > 0) {
            $invItemSectionCounts = $this->Invoices->InvoiceItems
                ->find('minors', ['application_id' => $appID, 'role_id' => $invoice->application->event->section_type->role_id])
                ->find('totalQuantity')
                ->toArray();

            $invSection = $invItemSectionCounts[0]->count;
        }

        $invNonSectionCount = $this->Invoices->InvoiceItems->find('minors', ['application_id' => $appID])->count();

        if ($invNonSectionCount > 0) {
            $invItemNonSecCounts = $this->Invoices->InvoiceItems
                ->find('minors', ['application_id' => $appID])
                ->find('totalQuantity')
                ->toArray();

            $invNonSection = $invItemNonSecCounts[0]->count;
            if ($invSection > 0 && isset($invSection)) {
                $invNonSection = $invNonSection - $invSection;
            }
        }

        $invAdultCount = $this->Invoices->InvoiceItems->find('adults', ['application_id' => $appID])->count();

        if ($invAdultCount > 0) {
            $invItemAdultCounts = $this->Invoices->InvoiceItems
                ->find('adults', ['application_id' => $appID])
                ->find('totalQuantity')
                ->toArray();

            $invLeaders = intval($invItemAdultCounts[0]->count);
        }

        $results = [
            'NumSection' => $invSection,
            'NumNonSection' => $invNonSection,
            'NumLeaders' => $invLeaders
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

        $section = $this->Events->Applications->find('section', ['role_id' => $roleId])->where(['Applications.event_id' => $eventId])->count();
        $nonSection = $this->Events->Applications->find('nonSection', ['role_id' => $roleId])->where(['Applications.event_id' => $eventId])->count();
        $leaders = $this->Events->Applications->find('leaders')->where(['Applications.event_id' => $eventId])->count();

        $results = [
            'NumSection' => $section,
            'NumNonSection' => $nonSection,
            'NumLeaders' => $leaders,
            'NumTeams' => $event->cc_apps,
        ];

        return $results;
    }

    /**
     * @param \App\Model\Entity\Event $event The Event
     * @param bool $flash Should the method emit Flash messages
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    private function checkEventOpen($event, $flash)
    {
        if (!$event->new_apps) {
            if ($flash) {
                $this->Flash->error(__('Apologies this Event is Not Currently Accepting Applications.'));
            }

            return false;
        }

        return true;
    }

    /**
     * @param string $type The Type to be checked
     * @param \App\Model\Entity\EventType $eventType The EventType of the Event
     * @param bool $flash Should the method emit Flash messages
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    private function checkBookingType($type, $eventType, $flash)
    {
        switch ($type) {
            case 'list':
                if (!$eventType->simple_booking) {
                    if ($flash) {
                        $this->Flash->error(__('This event is not configured for List Booking.'));
                    }

                    return false;
                }

                return true;
            case 'hold':
                if (!$eventType->hold_booking) {
                    if ($flash) {
                        $this->Flash->error(__('This event is not configured for Hold Booking.'));
                    }

                    return false;
                }

                return true;
            case 'district':
                if (!$eventType->district_booking) {
                    if ($flash) {
                        $this->Flash->error(__('This event is not configured for District Booking.'));
                    }

                    return false;
                }

                return true;
            case 'parent':
                if (!$eventType->parent_applications) {
                    if ($flash) {
                        $this->Flash->error(__('This event is not configured for Parent Applications.'));
                    }

                    return false;
                }

                return true;
            default:
                return true;
        }
    }

    /**
     * @param \App\Model\Entity\Event $event The EventType of the Event
     * @param bool $flash Should the method emit Flash messages
     * @param int $appId The ID of the App
     *
     * @return bool
     */
    private function checkBookingApp($event, $flash, $appId = null)
    {
        if (!$event->max) {
            return true;
        }

        if ($event->max_apps == 0 || is_null($event->max_apps)) {
            return true;
        }

        /** @var \App\Model\Table\ApplicationsTable Applications */
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        $applicationCount = $this->Applications->find('all')->where(['event_id' => $event->id])->count();

        if ($applicationCount >= $event->max_apps) {
            if ($flash) {
                $this->Flash->error(__('Apologies this Event is Full.'));
            }

            return false;
        }

        return true;
    }

    /**
     * @param \App\Model\Entity\Event $event The EventType of the Event
     * @param bool $flash Should the method emit Flash messages
     *
     * @return bool
     */
    private function checkBookingRes($event, $flash)
    {
        if (!$event->max) {
            return true;
        }

        if ($event->max_apps == 0 || is_null($event->max_apps)) {
            return true;
        }

        /** @var \App\Model\Table\ReservationsTable Reservations */
        $this->Reservations = TableRegistry::getTableLocator()->get('Reservations');
        $reservationCount = $this->Reservations->find('all')->where(['event_id' => $event->id])->count();

        if ($reservationCount >= $event->max_apps) {
            if ($flash) {
                $this->Flash->error(__('Apologies this Event is Full.'));
            }

            return false;
        }

        return true;
    }

    /**
     * @param int $sectionNumbers The Number to be checked
     * @param \App\Model\Entity\Event $event The EventType of the Event
     * @param bool $flash Should the method emit Flash messages
     * @param int $appId The ID of the App
     *
     * @return bool
     */
    private function checkBookingSection($sectionNumbers, $event, $flash, $appId = null)
    {
        if (!$event->max) {
            return true;
        }

        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $maxSection = $this->Events->getPriceSection($event->id);

        if ($sectionNumbers > $maxSection && !$maxSection == 0 && !is_null($maxSection)) {
            if ($flash) {
                $this->Flash->error(__('The team size is limited, please select fewer attendees.'));
            }

            return false;
        }

        if ($event->max_section == 0 || is_null($event->max_section)) {
            return true;
        }

        $overallNumbers = $this->getEventNumbers($event->id);
        $testNumbers = $sectionNumbers + $overallNumbers['NumSection'];

        if ($testNumbers >= $event->max_section) {
            if ($flash) {
                $this->Flash->error(__('The Event is Nearly Full, please reduce your numbers and try again.'));
            }

            return false;
        }

        return true;
    }

    /**
     * @param int $eventId The ID of the event
     * @param array $bookingData The Booking Data Array to be checked.
     * @param bool $flash Should the method emit Flash messages
     *
     * @return bool
     */
    public function checkBooking($eventId, $bookingData, $flash)
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get($eventId, [
            'contain' => [
                'SectionTypes.Roles',
                'EventTypes',
            ]
        ]);

        if (!$this->checkEventOpen($event, $flash)) {
            return false;
        }

        if (key_exists('booking_type', $bookingData)) {
            if (!$this->checkBookingType($bookingData['booking_type'], $event->event_type, $flash)) {
                return false;
            }
        }

        if (key_exists('section', $bookingData)) {
            if (!$this->checkBookingSection($bookingData['section'], $event, $flash)) {
                return false;
            }
        }

        if (!$this->checkBookingApp($event, $flash)) {
            return false;
        }

        return true;
    }

    /**
     * Check if an Event is Full
     *
     * @param int $eventId The ID of the Event
     * @param bool $flash Do Flash Messages
     *
     * @return bool
     */
    public function checkEventFull($eventId, $flash)
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get($eventId, [
            'contain' => [
                'SectionTypes.Roles',
                'EventTypes',
            ]
        ]);

        if (!$this->checkEventOpen($event, $flash)) {
            return true;
        }

        if (!$this->checkBookingApp($event, $flash)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $eventId The ID of the event
     * @param bool $flash Should the method emit Flash messages
     *
     * @return bool
     */
    public function checkReservation($eventId, $flash)
    {
        $this->Events = TableRegistry::getTableLocator()->get('Events');
        $event = $this->Events->get($eventId, [
            'contain' => [
                'SectionTypes.Roles',
                'EventTypes',
            ]
        ]);

        if (!$this->checkEventOpen($event, $flash)) {
            return false;
        }

        if (!$this->checkBookingType('parent', $event->event_type, $flash)) {
            return false;
        }

//        if (!$this->checkBookingSection(1, $event, $flash)) {
//            return false;
//        }

        if (!$this->checkBookingRes($event, $flash)) {
            return false;
        }

        return true;
    }

    /**
     * Function to load and deplete Logistic Limits
     *
     * @param int $logisticId ID of the Logistic in Question
     * @param int $paramId ID of the Param Selected
     *
     * @return null|bool
     */
    public function checkVariableLogistic($logisticId, $paramId)
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
}
