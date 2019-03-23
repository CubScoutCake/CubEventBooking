<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistic $logistic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $logistic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $logistic->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Logistics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logistics form large-9 medium-8 columns content">
    <?= $this->Form->create($logistic) ?>
    <fieldset>
        <legend><?= __('Edit Logistic') ?></legend>
        <?php
            echo $this->Form->control('event_id', ['options' => $events, 'empty' => true]);
            echo $this->Form->control('header');
            echo $this->Form->control('text');
            echo $this->Form->control('parameter_id', ['options' => $parameters, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
