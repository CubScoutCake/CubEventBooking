<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Token'), ['action' => 'edit', $token->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Token'), ['action' => 'delete', $token->id], ['confirm' => __('Are you sure you want to delete # {0}?', $token->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tokens'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Token'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Email Sends'), ['controller' => 'EmailSends', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Email Send'), ['controller' => 'EmailSends', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tokens view large-9 medium-8 columns content">
    <h3><?= h($token->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($token->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $token->has('user') ? $this->Html->link($token->user->full_name, ['controller' => 'Users', 'action' => 'view', $token->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Send') ?></th>
            <td><?= $token->has('email_send') ? $this->Html->link($token->email_send->id, ['controller' => 'EmailSends', 'action' => 'view', $token->email_send->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($token->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($token->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($token->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expires') ?></th>
            <td><?= h($token->expires) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Utilised') ?></th>
            <td><?= h($token->utilised) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $token->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
