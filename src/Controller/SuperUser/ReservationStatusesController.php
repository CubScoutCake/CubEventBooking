<?php
declare(strict_types=1);

namespace App\Controller\SuperUser;

/**
 * ReservationStatuses Controller
 *
 * @property \App\Model\Table\ReservationStatusesTable $ReservationStatuses
 *
 * @method \App\Model\Entity\ReservationStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array
 *     $settings = [])
 */
class ReservationStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $reservationStatuses = $this->paginate($this->ReservationStatuses);

        $this->set(compact('reservationStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation Status id.
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservationStatus = $this->ReservationStatuses->get($id, [
            'contain' => ['Reservations'],
        ]);

        $this->set('reservationStatus', $reservationStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reservationStatus = $this->ReservationStatuses->newEntity();
        if ($this->request->is('post')) {
            $reservationStatus = $this->ReservationStatuses->patchEntity($reservationStatus, $this->request->getData());
            if ($this->ReservationStatuses->save($reservationStatus)) {
                $this->Flash->success(__('The reservation status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation status could not be saved. Please, try again.'));
        }
        $this->set(compact('reservationStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation Status id.
     *
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reservationStatus = $this->ReservationStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservationStatus = $this->ReservationStatuses->patchEntity($reservationStatus, $this->request->getData());
            if ($this->ReservationStatuses->save($reservationStatus)) {
                $this->Flash->success(__('The reservation status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation status could not be saved. Please, try again.'));
        }
        $this->set(compact('reservationStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation Status id.
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservationStatus = $this->ReservationStatuses->get($id);
        if ($this->ReservationStatuses->delete($reservationStatus)) {
            $this->Flash->success(__('The reservation status has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
