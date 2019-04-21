<?php
namespace App\Controller;

use App\Form\AttNumberForm;
use App\Form\SyncBookForm;
use App\Model\Entity\Price;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Controller\Component\ScoutManagerComponent $ScoutManager
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
            'conditions' => ['live' => true]
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
            'contain' => ['Discounts', 'SectionTypes.Roles', 'Applications', 'EventTypes.InvoiceTexts', 'EventTypes.LegalTexts', 'EventTypes.ApplicationRefs']
        ]);

        $this->loadComponent('ScoutManager');
        $checkArray = $this->ScoutManager->checkOsmStatus($this->Auth->user('id'));
        $max_section = $this->Events->getPriceSection($eventID);

        $readyForSync = false;

        if ($checkArray['linked'] && $checkArray['sectionSet'] && $checkArray['termCurrent']) {
            $osmEvents = $this->ScoutManager->getEventList($this->Auth->user('id'));
            if (count($osmEvents) != 0) {
                $readyForSync = true;
            }
        }

        $attForm = new AttNumberForm();
        $syncForm = new SyncBookForm();

        if ($this->request->is('post')) {
            if ($event->cc_apps >= $event->max_apps && $event->max_apps != 0 && $event->max && !is_null($event->cc_apps)) {
                $this->Flash->error('This event is Full.');

                return;
            }

            $section = $this->request->getData('section');
            $nonSection = $this->request->getData('non_section');
            $leaders = $this->request->getData('leaders');
            $osm_event = $this->request->getData('osm_event');
            $bookingType = $this->request->getData('booking_type');

            if (!is_null($section)) {
                if ($section > $max_section && $max_section != 0 && !is_null($max_section)) {
                    $this->Flash->error('Booking Exceeds Maximum Numbers.');
                }

                if ($section <= $max_section || $max_section == 0 || is_null($max_section)) {
                    switch ($bookingType) {
                        case 'list':
                            return $this->redirect([
                                'controller' => 'Applications',
                                'action' => 'simple_book',
                                'prefix' => false,
                                $event->id,
                                '?' => [
                                    'section' => $section,
                                    'non_section' => $nonSection,
                                    'leaders' => $leaders,
                                ],
                            ]);
                        case 'hold':
                            return $this->redirect([
                                'controller' => 'Applications',
                                'action' => 'hold_book',
                                'prefix' => false,
                                $event->id,
                                '?' => [
                                    'section' => $section,
                                    'non_section' => $nonSection,
                                    'leaders' => $leaders,
                                ],
                            ]);
                        default:
                            break;
                    }
                }
            }

            if (!is_null($osm_event)) {
                $this->redirect([
                    'controller' => 'Applications',
                    'action' => 'sync_book',
                    'prefix' => false,
                    $event->id,
                    $osm_event
                ]);
            }
        }

        $term = $event->event_type->application_ref->text;
        $singleTerm = $term;
        $pluralTerm = Inflector::pluralize($term);

        if (($event->max_apps - $event->cc_apps) > 1) {
            $term = $pluralTerm;
        }

        $this->set(compact('event', 'term', 'attForm', 'holdForm', 'syncForm', 'section', 'non_section'));
        $this->set(compact('max_section', 'leaders', 'osmEvents', 'readyForSync', 'singleTerm'));
    }
}
