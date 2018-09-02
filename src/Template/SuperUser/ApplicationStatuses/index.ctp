<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationStatus[]|\Cake\Collection\CollectionInterface $applicationStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Application Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicationStatuses index large-9 medium-8 columns content">
    <h3><?= __('Application Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('application_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicationStatuses as $applicationStatus): ?>
            <tr>
                <td><?= $this->Number->format($applicationStatus->id) ?></td>
                <td><?= h($applicationStatus->application_status) ?></td>
                <td><?= h($applicationStatus->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicationStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicationStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicationStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationStatus->id)]) ?>
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
