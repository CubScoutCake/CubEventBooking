<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $eventType->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Event Types'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $eventType->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Event Types'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($eventType); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Event Type']) ?></legend>
    <?php
    echo $this->Form->input('event_type');
    echo $this->Form->input('simple_booking');
    echo $this->Form->input('date_of_birth');
    echo $this->Form->input('medical');
    echo $this->Form->input('parent_applications');
    echo $this->Form->input('invoice_text_id');
    echo $this->Form->input('legal_text_id', ['options' => $settings]);
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
