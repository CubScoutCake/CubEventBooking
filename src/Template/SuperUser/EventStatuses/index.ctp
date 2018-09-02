<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventStatus[]|\Cake\Collection\CollectionInterface $eventStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Event Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="eventStatuses index large-9 medium-8 columns content">
    <h3><?= __('Event Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('live') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accepting_applications') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventStatuses as $eventStatus): ?>
            <tr>
                <td><?= $this->Number->format($eventStatus->id) ?></td>
                <td><?= h($eventStatus->event_status) ?></td>
                <td><?= h($eventStatus->live) ?></td>
                <td><?= h($eventStatus->accepting_applications) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $eventStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventStatus->id)]) ?>
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
