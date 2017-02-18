<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

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
            'contain' => ['Settings', 'Discounts', 'Users', 'EventTypes'],
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
            'contain' => ['Discounts', 'Users', 'EventTypes', 'Settings', 'Applications', 'Logistics']
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
        $this->set(compact('users', 'payments', 'discount', 'invText', 'legal'));
    }

    /**
     * View method
     *
     * @param int|null $eventID Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function book($eventID)
    {
        $event = $this->Events->get($eventID, [
            'contain' => ['Settings', 'Discounts', 'Applications', 'EventTypes']
        ]);

        $eventTypes = TableRegistry::get('EventTypes');
        $type = $eventTypes->get($event['event_type_id']);

        $simple = $type->simple_booking;

        if ($simple == false && isset($simple)) {
            return $this->redirect(['controller' => 'Applications', 'action' => 'book', $eventID]);
        }

        $this->set(compact('event'));
    }
}
