<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Logistic Item'), ['action' => 'edit', $logisticItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Logistic Item'), ['action' => 'delete', $logisticItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logisticItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Params'), ['controller' => 'Params', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Param'), ['controller' => 'Params', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logisticItems view large-9 medium-8 columns content">
    <h3><?= h($logisticItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Application') ?></th>
            <td><?= $logisticItem->has('application') ? $this->Html->link($logisticItem->application->display_code, ['controller' => 'Applications', 'action' => 'view', $logisticItem->application->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Logistic') ?></th>
            <td><?= $logisticItem->has('logistic') ? $this->Html->link($logisticItem->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $logisticItem->logistic->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Param') ?></th>
            <td><?= $logisticItem->has('param') ? $this->Html->link($logisticItem->param->id, ['controller' => 'Params', 'action' => 'view', $logisticItem->param->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($logisticItem->id) ?></td>
        </tr>
    </table>
</div>
