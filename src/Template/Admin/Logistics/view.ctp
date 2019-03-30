<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistic $logistic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Logistic'), ['action' => 'edit', $logistic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Logistic'), ['action' => 'delete', $logistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Logistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logistics view large-9 medium-8 columns content">
    <h3><?= h($logistic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $logistic->has('event') ? $this->Html->link($logistic->event->name, ['controller' => 'Events', 'action' => 'view', $logistic->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Header') ?></th>
            <td><?= h($logistic->header) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Text') ?></th>
            <td><?= h($logistic->text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parameter') ?></th>
            <td><?= $logistic->has('parameter') ? $this->Html->link($logistic->parameter->parameter, ['controller' => 'Parameters', 'action' => 'view', $logistic->parameter->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($logistic->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Logistic Items') ?></h4>
        <?php if (!empty($logistic->logistic_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Application Id') ?></th>
                <th scope="col"><?= __('Logistic Id') ?></th>
                <th scope="col"><?= __('Param Id') ?></th>
                <th scope="col"><?= __('Reservation Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($logistic->logistic_items as $logisticItems): ?>
            <tr>
                <td><?= h($logisticItems->id) ?></td>
                <td><?= h($logisticItems->application_id) ?></td>
                <td><?= h($logisticItems->logistic_id) ?></td>
                <td><?= h($logisticItems->param_id) ?></td>
                <td><?= h($logisticItems->reservation_id) ?></td>
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
