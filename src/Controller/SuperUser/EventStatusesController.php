<?php
declare(strict_types=1);

namespace App\Controller\SuperUser;

/**
 * EventStatuses Controller
 *
 * @property \App\Model\Table\EventStatusesTable $EventStatuses
 *
 * @method \App\Model\Entity\EventStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings
 *     = [])
 */
class EventStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $eventStatuses = $this->paginate($this->EventStatuses);

        $this->set(compact('eventStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Event Status id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventStatus = $this->EventStatuses->get($id, [
            'contain' => ['Events'],
        ]);

        $this->set('eventStatus', $eventStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventStatus = $this->EventStatuses->newEntity();
        if ($this->request->is('post')) {
            $eventStatus = $this->EventStatuses->patchEntity($eventStatus, $this->request->getData());
            if ($this->EventStatuses->save($eventStatus)) {
                $this->Flash->success(__('The event status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event status could not be saved. Please, try again.'));
        }
        $this->set(compact('eventStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Status id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventStatus = $this->EventStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventStatus = $this->EventStatuses->patchEntity($eventStatus, $this->request->getData());
            if ($this->EventStatuses->save($eventStatus)) {
                $this->Flash->success(__('The event status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event status could not be saved. Please, try again.'));
        }
        $this->set(compact('eventStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Status id.
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventStatus = $this->EventStatuses->get($id);
        if ($this->EventStatuses->delete($eventStatus)) {
            $this->Flash->success(__('The event status has been deleted.'));
        } else {
            $this->Flash->error(__('The event status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
