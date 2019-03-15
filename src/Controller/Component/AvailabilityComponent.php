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
 */
class AvailabilityComponent extends Component
{
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
            'NumLeaders' => $leaders
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
