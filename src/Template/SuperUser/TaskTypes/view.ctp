<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskType $taskType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Task Type'), ['action' => 'edit', $taskType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task Type'), ['action' => 'delete', $taskType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taskType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Task Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="taskTypes view large-9 medium-8 columns content">
    <h3><?= h($taskType->task_type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Task Type') ?></th>
            <td><?= h($taskType->task_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Icon') ?></th>
            <td><?= h($taskType->type_icon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Code') ?></th>
            <td><?= h($taskType->type_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($taskType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shared Type') ?></th>
            <td><?= $taskType->shared_type ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Task Requirement') ?></h4>
        <?= $this->Text->autoParagraph(h($taskType->task_requirement)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tasks') ?></h4>
        <?php if (!empty($taskType->tasks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Task Type Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Completed') ?></th>
                <th scope="col"><?= __('Date Completed') ?></th>
                <th scope="col"><?= __('Completed By User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($taskType->tasks as $tasks): ?>
            <tr>
                <td><?= h($tasks->id) ?></td>
                <td><?= h($tasks->task_type_id) ?></td>
                <td><?= h($tasks->user_id) ?></td>
                <td><?= h($tasks->created) ?></td>
                <td><?= h($tasks->modified) ?></td>
                <td><?= h($tasks->completed) ?></td>
                <td><?= h($tasks->date_completed) ?></td>
                <td><?= h($tasks->completed_by_user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $tasks->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $tasks->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $tasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasks->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
