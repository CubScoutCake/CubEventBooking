<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reservation'), ['action' => 'edit', $reservation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reservation'), ['action' => 'delete', $reservation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reservations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reservation Statuses'), ['controller' => 'ReservationStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reservation Status'), ['controller' => 'ReservationStatuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invoices'), ['controller' => 'Invoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice'), ['controller' => 'Invoices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reservations view large-9 medium-8 columns content">
    <h3><?= h($reservation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $reservation->has('event') ? $this->Html->link($reservation->event->name, ['controller' => 'Events', 'action' => 'view', $reservation->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $reservation->has('user') ? $this->Html->link($reservation->user->full_name, ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attendee') ?></th>
            <td><?= $reservation->has('attendee') ? $this->Html->link($reservation->attendee->full_name, ['controller' => 'Attendees', 'action' => 'view', $reservation->attendee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reservation Status') ?></th>
            <td><?= $reservation->has('reservation_status') ? $this->Html->link($reservation->reservation_status->id, ['controller' => 'ReservationStatuses', 'action' => 'view', $reservation->reservation_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reservation Code') ?></th>
            <td><?= h($reservation->reservation_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reservation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($reservation->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($reservation->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($reservation->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expires') ?></th>
            <td><?= h($reservation->expires) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($reservation->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Application Id') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Paid') ?></th>
                <th scope="col"><?= __('Initialvalue') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Reservation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reservation->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->user_id) ?></td>
                <td><?= h($invoices->application_id) ?></td>
                <td><?= h($invoices->value) ?></td>
                <td><?= h($invoices->created) ?></td>
                <td><?= h($invoices->modified) ?></td>
                <td><?= h($invoices->paid) ?></td>
                <td><?= h($invoices->initialvalue) ?></td>
                <td><?= h($invoices->deleted) ?></td>
                <td><?= h($invoices->reservation_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invoices', 'action' => 'edit', $invoices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Logistic Items') ?></h4>
        <?php if (!empty($reservation->logistic_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Application Id') ?></th>
                <th scope="col"><?= __('Logistic Id') ?></th>
                <th scope="col"><?= __('Param Id') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Reservation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($reservation->logistic_items as $logisticItems): ?>
            <tr>
                <td><?= h($logisticItems->id) ?></td>
                <td><?= h($logisticItems->application_id) ?></td>
                <td><?= h($logisticItems->logistic_id) ?></td>
                <td><?= h($logisticItems->param_id) ?></td>
                <td><?= h($logisticItems->deleted) ?></td>
                <td><?= h($logisticItems->reservation_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LogisticItems', 'action' => 'view', $logisticItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LogisticItems', 'action' => 'edit', $logisticItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LogisticItems', 'action' => 'delete', $logisticItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logisticItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
