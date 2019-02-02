<?php
namespace App\Controller\Admin;

/**
 * Discounts Controller
 *
 * @property \App\Model\Table\DiscountsTable $Discounts
 */
class DiscountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set('discounts', $this->paginate($this->Discounts));
        $this->set('_serialize', ['discounts']);
    }

    /**
     * View method
     *
     * @param string|null $discountId Discount id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function view($discountId = null)
    {
        $discount = $this->Discounts->get($discountId, [
            'contain' => ['Events']
        ]);
        $this->set('discount', $discount);
        $this->set('_serialize', ['discount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $discount = $this->Discounts->newEntity();
        if ($this->request->is('post')) {
            $discount = $this->Discounts->patchEntity($discount, $this->request->getData());
            if ($this->Discounts->save($discount)) {
                $this->Flash->success(__('The discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The discount could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('discount'));
        $this->set('_serialize', ['discount']);
    }

    /**
     * Edit method
     *
     * @param string|null $discountId Discount id.
     * @return \Cake\Http\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function edit($discountId = null)
    {
        $discount = $this->Discounts->get($discountId, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $discount = $this->Discounts->patchEntity($discount, $this->request->getData());
            if ($this->Discounts->save($discount)) {
                $this->Flash->success(__('The discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The discount could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('discount'));
        $this->set('_serialize', ['discount']);
    }

    /**
     * Delete method
     *
     * @param string|null $discountId Discount id.
     * @return \Cake\Http\Response|void Redirects to index.
     * @throws \Cake\Http\Exception\NotFoundException When record not found.
     */
    public function delete($discountId = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $discount = $this->Discounts->get($discountId);
        if ($this->Discounts->delete($discount)) {
            $this->Flash->success(__('The discount has been deleted.'));
        } else {
            $this->Flash->error(__('The discount could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
