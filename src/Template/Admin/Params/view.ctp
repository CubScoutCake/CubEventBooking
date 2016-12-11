<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Param'), ['action' => 'edit', $param->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Param'), ['action' => 'delete', $param->id], ['confirm' => __('Are you sure you want to delete # {0}?', $param->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Params'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Param'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="params view large-9 medium-8 columns content">
    <h3><?= h($param->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Parameter') ?></th>
            <td><?= $param->has('parameter') ? $this->Html->link($param->parameter->id, ['controller' => 'Parameters', 'action' => 'view', $param->parameter->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Constant') ?></th>
            <td><?= h($param->constant) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($param->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Logistic Items') ?></h4>
        <?php if (!empty($param->logistic_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Application Id') ?></th>
                <th><?= __('Logistic Id') ?></th>
                <th><?= __('Param Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($param->logistic_items as $logisticItems): ?>
            <tr>
                <td><?= h($logisticItems->id) ?></td>
                <td><?= h($logisticItems->application_id) ?></td>
                <td><?= h($logisticItems->logistic_id) ?></td>
                <td><?= h($logisticItems->param_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LogisticItems', 'action' => 'view', $logisticItems->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'LogisticItems', 'action' => 'edit', $logisticItems->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LogisticItems', 'action' => 'delete', $logisticItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logisticItems->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
