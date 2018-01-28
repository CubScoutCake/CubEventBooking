<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\AttNumberForm;
use App\Form\SyncBookForm;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
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
     * @param int|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Discounts', 'AdminUsers', 'EventTypes', 'Settings', 'Applications']
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);

        // Get Entities from Registry
        $settings = TableRegistry::get('Settings');
        $discounts = TableRegistry::get('Discounts');

        $now = Time::now();
        $userId = $this->Auth->user('id');

        // Table Entities
        if (isset($event->discount_id)) {
            $discount = $discounts->get($event->discount_id);
        }
        if (isset($event->legaltext_id)) {
            $legal = $settings->get($event->legaltext_id);
        }
        if (isset($event->invtext_id)) {
            $invText = $settings->get($event->invtext_id);
        }

        // Pass to View
        $this->set(compact('AdminUsers', 'payments', 'discount', 'invText', 'legal'));
    }

    /**
     * View method
     *
     * @param int|null $eventID Event id.
     * @return null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function book($eventID)
    {
        $event = $this->Events->get($eventID, [
            'contain' => ['Discounts', 'SectionTypes', 'Applications', 'EventTypes.InvoiceTexts', 'EventTypes.LegalTexts', 'EventTypes.ApplicationRefs']
        ]);

        $term = $event->event_type->application_ref->text;

        if (($event->max_apps - $event->cc_apps) > 1) {
            $term = Inflector::pluralize($term);
        }

        $this->loadComponent('ScoutManager');
        $checkArray = $this->ScoutManager->checkOsmStatus($this->Auth->user('id'));

        $readyForSync = false;

        if ($checkArray['linked'] && $checkArray['sectionSet'] && $checkArray['termCurrent']) {
            $osmEvents = $this->ScoutManager->getEventList($this->Auth->user('id'));
            $readyForSync = true;
        }

        $attForm = new AttNumberForm();
        $syncForm = new SyncBookForm();

        if ($this->request->is('post')) {
            $section = $this->request->getData('section');
            $nonSection = $this->request->getData('non_section');
            $leaders = $this->request->getData('leaders');
            $osm_event = $this->request->getData('osm_event');

            if (!is_null($section)) {
                $this->redirect([
                    'controller' => 'Applications',
                    'action' => 'simple_book',
                    'prefix' => false,
                    $event->id,
                    $section,
                    $nonSection,
                    $leaders,
                ]);
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

        $this->set(compact('event', 'term', 'attForm', 'syncForm', 'section', 'non_section', 'leaders', 'osmEvents', 'readyForSync'));
    }
}
