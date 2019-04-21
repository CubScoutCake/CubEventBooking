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
 * @property \App\Model\Table\InvoicesTable $Invoices
 * @property \App\Model\Table\EventsTable $Events
 *
 * @property \Cake\Controller\Component\FlashComponent $Flash
 */
class AvailabilityComponent extends Component
{
    public $components = ['Flash'];

    /**
     * Retrieve an Array of Numbers for the Number of Attendees.
     *
     * @param int $applicationId The application to be analysed
     * @return array
     */
    public function getApplicationNumbers($applicationId)
    {
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        /**
         * @var \App\Model\Entity\Application $application
         */
        $application = $this->Applications->get($applicationId, ['contain' => 'Events.SectionTypes.Roles']);
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
            'NumLeaders' => $leaders
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

        /** @var \App\Model\Table\ApplicationsTable Applications */
        $this->Applications = TableRegistry::getTableLocator()->get('Applications');
        $applicationCount = $this->Applications->find('all')->where(['event_id' => $event->id])->count();

        if ($applicationCount > $event->max_apps) {
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

        if ($maxSection == 0 || is_null($maxSection)) {
            return true;
        }

        if ($sectionNumbers > $maxSection) {
            if ($flash) {
                $this->Flash->error(__('Event is nearly Full. Too many attendees.'));
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
}
