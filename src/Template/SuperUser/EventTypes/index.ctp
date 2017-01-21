<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('New Event Type'), ['action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']); ?></li>
    <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']); ?></li>
    <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('event_type'); ?></th>
            <th><?= $this->Paginator->sort('simple_booking'); ?></th>
            <th><?= $this->Paginator->sort('date_of_birth'); ?></th>
            <th><?= $this->Paginator->sort('medical'); ?></th>
            <th><?= $this->Paginator->sort('parent_applications'); ?></th>
            <th><?= $this->Paginator->sort('invoice_text_id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventTypes as $eventType): ?>
        <tr>
            <td><?= $this->Number->format($eventType->id) ?></td>
            <td><?= h($eventType->event_type) ?></td>
            <td><?= h($eventType->simple_booking) ?></td>
            <td><?= h($eventType->date_of_birth) ?></td>
            <td><?= h($eventType->medical) ?></td>
            <td><?= h($eventType->parent_applications) ?></td>
            <td><?= $this->Number->format($eventType->invoice_text_id) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $eventType->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $eventType->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $eventType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventType->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
