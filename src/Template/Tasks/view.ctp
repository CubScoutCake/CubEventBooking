<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Task Types'), ['controller' => 'TaskTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task Type'), ['controller' => 'TaskTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tasks view large-9 medium-8 columns content">
    <h3><?= h($task->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Task Type') ?></th>
            <td><?= $task->has('task_type') ? $this->Html->link($task->task_type->id, ['controller' => 'TaskTypes', 'action' => 'view', $task->task_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $task->has('user') ? $this->Html->link($task->user->full_name, ['controller' => 'Users', 'action' => 'view', $task->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($task->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($task->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($task->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($task->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Completed') ?></th>
            <td><?= h($task->date_completed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Completed') ?></th>
            <td><?= $task->completed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
