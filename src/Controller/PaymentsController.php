<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $subquery = $this
            ->Payments
            ->find()
            ->select(['id'])
            ->matching('Invoices', function ($q) {
                return $q->where(['Invoices.user_id' => $this->Auth->user('id')]);
            });

        $myPayments = $this->paginate(
            $this
                ->Payments
                ->find()
                ->where(['id IN' => $subquery])
                ->contain(['Invoices'])
                ->order(['created' => 'DESC'])
        );

        $this->set('payments', $myPayments);
        $this->set('_serialize', ['payments']);
    }
}
