<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Params'), ['controller' => 'Params', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Param'), ['controller' => 'Params', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logisticItems index large-9 medium-8 columns content">
    <h3><?= __('Logistic Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('application_id') ?></th>
                <th><?= $this->Paginator->sort('logistic_id') ?></th>
                <th><?= $this->Paginator->sort('param_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logisticItems as $logisticItem): ?>
            <tr>
                <td><?= $this->Number->format($logisticItem->id) ?></td>
                <td><?= $logisticItem->has('application') ? $this->Html->link($logisticItem->application->display_code, ['controller' => 'Applications', 'action' => 'view', $logisticItem->application->id]) : '' ?></td>
                <td><?= $logisticItem->has('logistic') ? $this->Html->link($logisticItem->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $logisticItem->logistic->id]) : '' ?></td>
                <td><?= $logisticItem->has('param') ? $this->Html->link($logisticItem->param->id, ['controller' => 'Params', 'action' => 'view', $logisticItem->param->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $logisticItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $logisticItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $logisticItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logisticItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
