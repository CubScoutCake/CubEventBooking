<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventStatus $eventStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Event Statuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($eventStatus) ?>
    <fieldset>
        <legend><?= __('Add Event Status') ?></legend>
        <?php
            echo $this->Form->control('event_status');
            echo $this->Form->control('live');
            echo $this->Form->control('accepting_applications');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
