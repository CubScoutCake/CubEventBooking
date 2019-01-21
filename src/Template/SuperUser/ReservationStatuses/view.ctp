<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservationStatus $reservationStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reservation Status'), ['action' => 'edit', $reservationStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reservation Status'), ['action' => 'delete', $reservationStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservationStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reservation Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reservationStatuses view large-9 medium-8 columns content">
    <h3><?= h($reservationStatus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Reservation Status') ?></th>
            <td><?= h($reservationStatus->reservation_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reservationStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $reservationStatus->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Complete') ?></th>
            <td><?= $reservationStatus->complete ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reservations') ?></h4>
        <?php if (!empty($reservationStatus->reservations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Attendee Id') ?></th>
                <th scope="col"><?= __('Reservation Status Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Expires') ?></th>
                <th scope="col"><?= __('Reservation Code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reservationStatus->reservations as $reservations): ?>
            <tr>
                <td><?= h($reservations->id) ?></td>
                <td><?= h($reservations->event_id) ?></td>
                <td><?= h($reservations->user_id) ?></td>
                <td><?= h($reservations->attendee_id) ?></td>
                <td><?= h($reservations->reservation_status_id) ?></td>
                <td><?= h($reservations->created) ?></td>
                <td><?= h($reservations->modified) ?></td>
                <td><?= h($reservations->deleted) ?></td>
                <td><?= h($reservations->expires) ?></td>
                <td><?= h($reservations->reservation_code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reservations', 'action' => 'view', $reservations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reservations', 'action' => 'edit', $reservations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reservations', 'action' => 'delete', $reservations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
