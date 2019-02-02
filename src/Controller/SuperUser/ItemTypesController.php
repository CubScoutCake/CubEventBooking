<?php
namespace App\Controller\SuperUser;

use App\Controller\SuperUser\AppController;

/**
 * ItemTypes Controller
 *
 * @property \App\Model\Table\ItemTypesTable $ItemTypes
 */
class ItemTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $itemTypes = $this->paginate($this->ItemTypes);

        $this->set(compact('itemTypes'));
        $this->set('_serialize', ['itemTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Item Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemType = $this->ItemTypes->get($id, [
            'contain' => ['InvoiceItems']
        ]);

        $this->set('itemType', $itemType);
        $this->set('_serialize', ['itemType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemType = $this->ItemTypes->newEntity();
        if ($this->request->is('post')) {
            $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());
            if ($this->ItemTypes->save($itemType)) {
                $this->Flash->success(__('The item type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item type could not be saved. Please, try again.'));
            }
        }

        $roles = $this->ItemTypes->Roles->find('list');

        $this->set(compact('itemType', 'roles'));
        $this->set('_serialize', ['itemType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Type id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemType = $this->ItemTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemType = $this->ItemTypes->patchEntity($itemType, $this->request->getData());
            if ($this->ItemTypes->save($itemType)) {
                $this->Flash->success(__('The item type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The item type could not be saved. Please, try again.'));
            }
        }

        $roles = $this->ItemTypes->Roles->find('list');

        $this->set(compact('itemType', 'roles'));
        $this->set('_serialize', ['itemType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Type id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemType = $this->ItemTypes->get($id);
        if ($this->ItemTypes->delete($itemType)) {
            $this->Flash->success(__('The item type has been deleted.'));
        } else {
            $this->Flash->error(__('The item type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
