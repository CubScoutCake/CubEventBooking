<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReservationStatus $reservationStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $reservationStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $reservationStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reservation Statuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Reservations'), ['controller' => 'Reservations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reservation'), ['controller' => 'Reservations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reservationStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($reservationStatus) ?>
    <fieldset>
        <legend><?= __('Edit Reservation Status') ?></legend>
        <?php
            echo $this->Form->control('reservation_status');
            echo $this->Form->control('active');
            echo $this->Form->control('complete');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
