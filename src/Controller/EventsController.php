<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\AttNumberForm;
use App\Form\SyncBookForm;
use Cake\Utility\Inflector;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Controller\Component\ScoutManagerComponent $ScoutManager
 * @property \App\Controller\Component\AvailabilityComponent $Availability
 */
class EventsController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Settings', 'Discounts', 'AdminUsers', 'EventTypes'],
            'conditions' => ['live' => true],
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param int|null $eventID Event id.
     * @return void|\Cake\Http\Response
     * @throws \Cake\Datasource\Exception\RecordNotFoundException|\Exception When record not found.
     */
    public function book($eventID)
    {
        $event = $this->Events->get($eventID, [
            'contain' => [
                'Discounts',
                'SectionTypes.Roles',
                'Applications',
                'EventTypes.InvoiceTexts',
                'EventTypes.LegalTexts',
                'EventTypes.ApplicationRefs'
            ],
        ]);

        $this->loadComponent('ScoutManager');
        $checkArray = $this->ScoutManager->checkOsmStatus($this->Auth->user('id'));
        $max_section = $this->Events->getPriceSection($eventID);

        $this->loadComponent('Availability');
        $eventNumbers = $this->Availability->getEventApplicationNumbers($eventID);
        $eventFull = $this->Availability->checkEventFull($eventID, true);

        $readyForSync = false;

        if ($checkArray['linked'] && $checkArray['sectionSet'] && $checkArray['termCurrent']) {
            $osmEvents = $this->ScoutManager->getEventList($this->Auth->user('id'));
            if (count($osmEvents) != 0) {
                $readyForSync = true;
            }
        }

        $attForm = new AttNumberForm();
        $syncForm = new SyncBookForm();

        if ($this->request->is('post') && !$eventFull) {
            $bookingData = $this->request->getData();
            if (!empty($this->request->getData('section'))) {
                if ($this->Availability->checkBooking($eventID, $bookingData, true)) {
                    $redirectArray = [
                        'section' => $bookingData['section'],
                        'non_section' => $bookingData['non_section'],
                        'leaders' => $bookingData['leaders'],
                    ];
                    switch ($bookingData['booking_type']) {
                        case 'list':
                            return $this->redirect([
                                'controller' => 'Applications',
                                'action' => 'simple_book',
                                'prefix' => false,
                                $event->id,
                                '?' => $redirectArray,
                            ]);
                        case 'hold':
                            return $this->redirect([
                                'controller' => 'Applications',
                                'action' => 'hold_book',
                                'prefix' => false,
                                $event->id,
                                '?' => $redirectArray,
                            ]);
                        default:
                            break;
                    }
                }
            }

            if (!is_null($bookingData['osm_event'])) {
                $this->redirect([
                    'controller' => 'Applications',
                    'action' => 'sync_book',
                    'prefix' => false,
                    $event->id,
                    $bookingData['osm_event'],
                ]);
            }
        }

        $term = $event->event_type->application_ref->text;
        $singleTerm = $term;
        $pluralTerm = Inflector::pluralize($term);

        if ($event->max_apps - $event->cc_apps > 1) {
            $term = $pluralTerm;
        }

        $this->set(compact('event', 'term', 'attForm', 'syncForm', 'eventNumbers', 'eventFull'));
        $this->set(compact('max_section', 'osmEvents', 'readyForSync', 'singleTerm'));
    }
}
