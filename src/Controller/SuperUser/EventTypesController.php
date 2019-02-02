<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * EventTypes Controller
 *
 * @property \App\Model\Table\EventTypesTable $EventTypes
 */
class EventTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LegalTexts', 'InvoiceTexts', 'ApplicationRefs']
        ];
        $eventTypes = $this->paginate($this->EventTypes);

        $this->set(compact('eventTypes'));
        $this->set('_serialize', ['eventTypes']);
    }

    /**
     * View method
     *
     * @param string|null $eventTypeId Event Type id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($eventTypeId = null)
    {
        $eventType = $this->EventTypes->get($eventTypeId, [
            'contain' => ['LegalTexts', 'InvoiceTexts', 'ApplicationRefs', 'Events']
        ]);

        $this->set('eventType', $eventType);
        $this->set('_serialize', ['eventType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventType = $this->EventTypes->newEntity();
        if ($this->request->is('post')) {
            $eventType = $this->EventTypes->patchEntity($eventType, $this->request->getData());
            if ($this->EventTypes->save($eventType)) {
                $this->Flash->success(__('The event type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event type could not be saved. Please, try again.'));
            }
        }
        $invoiceTexts = $this->EventTypes->InvoiceTexts->find('list', ['limit' => 200]);
        $legalTexts = $this->EventTypes->LegalTexts->find('list', ['limit' => 200]);
        $applicationRefs = $this->EventTypes->ApplicationRefs->find('list', ['limit' => 200]);
        $this->set(compact('eventType', 'invoiceTexts', 'legalTexts', 'applicationRefs'));
        $this->set('_serialize', ['eventType']);
    }

    /**
     * Edit method
     *
     * @param string|null $eventTypeId Event Type id.
     *
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($eventTypeId = null)
    {
        $eventType = $this->EventTypes->get($eventTypeId, [
            'contain' => ['InvoiceTexts', 'LegalTexts', 'ApplicationRefs']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventType = $this->EventTypes->patchEntity($eventType, $this->request->getData());
            if ($this->EventTypes->save($eventType)) {
                $this->Flash->success(__('The event type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event type could not be saved. Please, try again.'));
            }
        }
        $invoiceTexts = $this->EventTypes->InvoiceTexts->find('list', ['limit' => 200]);
        $legalTexts = $this->EventTypes->LegalTexts->find('list', ['limit' => 200]);
        $applicationRefs = $this->EventTypes->ApplicationRefs->find('list', ['limit' => 200]);
        $this->set(compact('eventType', 'invoiceTexts', 'legalTexts', 'applicationRefs'));
        $this->set('_serialize', ['eventType']);
    }

    /**
     * Delete method
     *
     * @param string|null $eventTypeId Event Type id.
     *
     * @return \Cake\Http\Response|null Redirects to index.
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($eventTypeId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventType = $this->EventTypes->get($eventTypeId);
        if ($this->EventTypes->delete($eventType)) {
            $this->Flash->success(__('The event type has been deleted.'));
        } else {
            $this->Flash->error(__('The event type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
