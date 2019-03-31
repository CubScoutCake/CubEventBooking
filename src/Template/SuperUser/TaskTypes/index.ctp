<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskType[]|\Cake\Collection\CollectionInterface $taskTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Task Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taskTypes index large-9 medium-8 columns content">
    <h3><?= __('Task Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('task_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shared_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_icon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taskTypes as $taskType): ?>
            <tr>
                <td><?= $this->Number->format($taskType->id) ?></td>
                <td><?= h($taskType->task_type) ?></td>
                <td><?= h($taskType->shared_type) ?></td>
                <td><?= h($taskType->type_icon) ?></td>
                <td><?= h($taskType->type_code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $taskType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $taskType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $taskType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $taskType->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
