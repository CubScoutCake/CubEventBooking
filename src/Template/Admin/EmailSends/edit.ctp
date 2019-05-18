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
                ['action' => 'delete', $emailSend->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $emailSend->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Email Sends'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notification Types'), ['controller' => 'NotificationTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notification Type'), ['controller' => 'NotificationTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Email Responses'), ['controller' => 'EmailResponses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Email Response'), ['controller' => 'EmailResponses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tokens'), ['controller' => 'Tokens', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Token'), ['controller' => 'Tokens', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="emailSends form large-9 medium-8 columns content">
    <?= $this->Form->create($emailSend) ?>
    <fieldset>
        <legend><?= __('Edit Email Send') ?></legend>
        <?php
            echo $this->Form->input('sent');
            echo $this->Form->input('message_send_code');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('subject');
            echo $this->Form->input('routing_domain');
            echo $this->Form->input('from_address');
            echo $this->Form->input('friendly_from');
            echo $this->Form->input('notification_type_id', ['options' => $notificationTypes, 'empty' => true]);
            echo $this->Form->input('notification_id', ['options' => $notifications, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
