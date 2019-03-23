<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistic[]|\Cake\Collection\CollectionInterface $logistics
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Logistic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logistics index large-9 medium-8 columns content">
    <h3><?= __('Logistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('header') ?></th>
                <th scope="col"><?= $this->Paginator->sort('text') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parameter_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logistics as $logistic): ?>
            <tr>
                <td><?= $this->Number->format($logistic->id) ?></td>
                <td><?= $logistic->has('event') ? $this->Html->link($logistic->event->name, ['controller' => 'Events', 'action' => 'view', $logistic->event->id]) : '' ?></td>
                <td><?= h($logistic->header) ?></td>
                <td><?= h($logistic->text) ?></td>
                <td><?= $logistic->has('parameter') ? $this->Html->link($logistic->parameter->parameter, ['controller' => 'Parameters', 'action' => 'view', $logistic->parameter->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $logistic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $logistic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $logistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistic->id)]) ?>
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
