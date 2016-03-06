<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Logistic'), ['action' => 'edit', $logistic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Logistic'), ['action' => 'delete', $logistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Logistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logisticstypes'), ['controller' => 'Logisticstypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logisticstype'), ['controller' => 'Logisticstypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logistics view large-9 medium-8 columns content">
    <h3><?= h($logistic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Application') ?></th>
            <td><?= $logistic->has('application') ? $this->Html->link($logistic->application->display_code, ['controller' => 'Applications', 'action' => 'view', $logistic->application->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Logisticstype') ?></th>
            <td><?= $logistic->has('logisticstype') ? $this->Html->link($logistic->logisticstype->id, ['controller' => 'Logisticstypes', 'action' => 'view', $logistic->logisticstype->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Header') ?></th>
            <td><?= h($logistic->header) ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($logistic->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Parameter') ?></th>
            <td><?= $logistic->has('parameter') ? $this->Html->link($logistic->parameter->id, ['controller' => 'Parameters', 'action' => 'view', $logistic->parameter->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($logistic->id) ?></td>
        </tr>
    </table>
</div>
