<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $emailResponseType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $emailResponseType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Email Response Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Email Responses'), ['controller' => 'EmailResponses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Email Response'), ['controller' => 'EmailResponses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="emailResponseTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($emailResponseType) ?>
    <fieldset>
        <legend><?= __('Edit Email Response Type') ?></legend>
        <?php
            echo $this->Form->input('email_response_type');
            echo $this->Form->input('bounce');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
