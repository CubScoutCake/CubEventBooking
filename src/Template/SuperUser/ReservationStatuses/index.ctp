<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservationStatus[]|\Cake\Collection\CollectionInterface $reservationStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reservation Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservationStatuses index large-9 medium-8 columns content">
    <h3><?= __('Reservation Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reservation_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('complete') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservationStatuses as $reservationStatus): ?>
            <tr>
                <td><?= $this->Number->format($reservationStatus->id) ?></td>
                <td><?= h($reservationStatus->reservation_status) ?></td>
                <td><?= h($reservationStatus->active) ?></td>
                <td><?= h($reservationStatus->complete) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reservationStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reservationStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reservationStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservationStatus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
