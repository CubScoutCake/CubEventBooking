<?php
namespace App\Controller\Admin;

/**
 * Logistics Controller
 *
 * @property \App\Model\Table\LogisticsTable $Logistics
 *
 * @method \App\Model\Entity\Logistic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogisticsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parameters', 'Events']
        ];
        $logistics = $this->paginate($this->Logistics);

        $this->set(compact('logistics'));
    }

    /**
     * View method
     *
     * @param string|null $id Logistic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logistic = $this->Logistics->get($id, [
            'contain' => ['Parameters', 'Events', 'LogisticItems']
        ]);

        $this->set('logistic', $logistic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logistic = $this->Logistics->newEntity();
        if ($this->request->is('post')) {
            $logistic = $this->Logistics->patchEntity($logistic, $this->request->getData());
            if ($this->Logistics->save($logistic)) {
                $this->Flash->success(__('The logistic has been saved.'));

                return $this->redirect(['action' => 'view', $logistic->get('id')]);
            }
            $this->Flash->error(__('The logistic could not be saved. Please, try again.'));
        }
        $parameters = $this->Logistics->Parameters->find('list', ['limit' => 200]);
        $events = $this->Logistics->Events->find('list', ['limit' => 200]);
        $this->set(compact('logistic', 'parameters', 'events'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Logistic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logistic = $this->Logistics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logistic = $this->Logistics->patchEntity($logistic, $this->request->getData());
            if ($this->Logistics->save($logistic)) {
                $this->Flash->success(__('The logistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logistic could not be saved. Please, try again.'));
        }
        $parameters = $this->Logistics->Parameters->find('list', ['limit' => 200]);
        $events = $this->Logistics->Events->find('list', ['limit' => 200]);
        $this->set(compact('logistic', 'parameters', 'events'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Logistic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logistic = $this->Logistics->get($id);
        if ($this->Logistics->delete($logistic)) {
            $this->Flash->success(__('The logistic has been deleted.'));
        } else {
            $this->Flash->error(__('The logistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
