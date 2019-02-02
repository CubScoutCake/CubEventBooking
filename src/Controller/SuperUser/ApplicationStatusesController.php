<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * ApplicationStatuses Controller
 *
 * @property \App\Model\Table\ApplicationStatusesTable $ApplicationStatuses
 *
 * @method \App\Model\Entity\ApplicationStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicationStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $applicationStatuses = $this->paginate($this->ApplicationStatuses);

        $this->set(compact('applicationStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Application Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicationStatus = $this->ApplicationStatuses->get($id, [
            'contain' => ['Applications']
        ]);

        $this->set('applicationStatus', $applicationStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicationStatus = $this->ApplicationStatuses->newEntity();
        if ($this->request->is('post')) {
            $applicationStatus = $this->ApplicationStatuses->patchEntity($applicationStatus, $this->request->getData());
            if ($this->ApplicationStatuses->save($applicationStatus)) {
                $this->Flash->success(__('The application status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application status could not be saved. Please, try again.'));
        }
        $this->set(compact('applicationStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Application Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicationStatus = $this->ApplicationStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationStatus = $this->ApplicationStatuses->patchEntity($applicationStatus, $this->request->getData());
            if ($this->ApplicationStatuses->save($applicationStatus)) {
                $this->Flash->success(__('The application status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application status could not be saved. Please, try again.'));
        }
        $this->set(compact('applicationStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Application Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicationStatus = $this->ApplicationStatuses->get($id);
        if ($this->ApplicationStatuses->delete($applicationStatus)) {
            $this->Flash->success(__('The application status has been deleted.'));
        } else {
            $this->Flash->error(__('The application status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
