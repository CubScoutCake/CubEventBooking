<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Logisticstype'), ['action' => 'edit', $logisticstype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Logisticstype'), ['action' => 'delete', $logisticstype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logisticstype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Logisticstypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logisticstype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logisticstypes view large-9 medium-8 columns content">
    <h3><?= h($logisticstype->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Logistics Type') ?></th>
            <td><?= h($logisticstype->logistics_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Type Description') ?></th>
            <td><?= h($logisticstype->type_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($logisticstype->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Logistics') ?></h4>
        <?php if (!empty($logisticstype->logistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Application Id') ?></th>
                <th><?= __('Logisticstype Id') ?></th>
                <th><?= __('Header') ?></th>
                <th><?= __('Text') ?></th>
                <th><?= __('Parameter Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($logisticstype->logistics as $logistics): ?>
            <tr>
                <td><?= h($logistics->id) ?></td>
                <td><?= h($logistics->application_id) ?></td>
                <td><?= h($logistics->logisticstype_id) ?></td>
                <td><?= h($logistics->header) ?></td>
                <td><?= h($logistics->text) ?></td>
                <td><?= h($logistics->parameter_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Logistics', 'action' => 'view', $logistics->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Logistics', 'action' => 'edit', $logistics->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Logistics', 'action' => 'delete', $logistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistics->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
