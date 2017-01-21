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
     * @param int|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function book($id)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Settings', 'Discounts', 'Applications']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $discounts = $this->Events->Discounts->find('list', ['limit' => 200]);
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $this->set(compact('event', 'discounts', 'users'));
        $this->set('_serialize', ['event']);
    }
}
