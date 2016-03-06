<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Logisticstype'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logisticstypes index large-9 medium-8 columns content">
    <h3><?= __('Logisticstypes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('logistics_type') ?></th>
                <th><?= $this->Paginator->sort('type_description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logisticstypes as $logisticstype): ?>
            <tr>
                <td><?= $this->Number->format($logisticstype->id) ?></td>
                <td><?= h($logisticstype->logistics_type) ?></td>
                <td><?= h($logisticstype->type_description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $logisticstype->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $logisticstype->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $logisticstype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logisticstype->id)]) ?>
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
