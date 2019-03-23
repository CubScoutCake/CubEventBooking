<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Logistic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logistics index large-9 medium-8 columns content">
    <h3><?= __('Logistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('parameter_id') ?></th>
                <th><?= $this->Paginator->sort('event_id') ?></th>
                <th><?= $this->Paginator->sort('header') ?></th>
                <th><?= $this->Paginator->sort('text') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php /** @var \App\Model\Entity\Logistic[] $logistics */ ?>
            <?php foreach ($logistics as $logistic): ?>
            <tr>
                <td><?= $this->Number->format($logistic->id) ?></td>
                <td><?= $logistic->has('parameter') ? $this->Html->link($logistic->parameter->id, ['controller' => 'Parameters', 'action' => 'view', $logistic->parameter->id]) : '' ?></td>
                <td><?= $this->Number->format($logistic->event_id) ?></td>
                <td><?= h($logistic->header) ?></td>
                <td><?= h($logistic->text) ?></td>
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
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
