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
                ['action' => 'delete', $token->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $token->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tokens'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Email Sends'), ['controller' => 'EmailSends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Email Send'), ['controller' => 'EmailSends', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tokens form large-9 medium-8 columns content">
    <?= $this->Form->create($token) ?>
    <fieldset>
        <legend><?= __('Edit Token') ?></legend>
        <?php
            echo $this->Form->input('token');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('email_send_id', ['options' => $emailSends]);
            echo $this->Form->input('expires');
            echo $this->Form->input('utilised');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
