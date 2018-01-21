<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Email Responses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Email Sends'), ['controller' => 'EmailSends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Email Send'), ['controller' => 'EmailSends', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Email Response Types'), ['controller' => 'EmailResponseTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Email Response Type'), ['controller' => 'EmailResponseTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="emailResponses form large-9 medium-8 columns content">
    <?= $this->Form->create($emailResponse) ?>
    <fieldset>
        <legend><?= __('Add Email Response') ?></legend>
        <?php
            echo $this->Form->input('email_send_id', ['options' => $emailSends]);
            echo $this->Form->input('email_response_type_id', ['options' => $emailResponseTypes]);
            echo $this->Form->input('received');
            echo $this->Form->input('link_clicked');
            echo $this->Form->input('ip_address');
            echo $this->Form->input('bounce_reason');
            echo $this->Form->input('message_size');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
