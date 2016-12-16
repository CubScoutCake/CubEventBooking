<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parameter'), ['action' => 'edit', $parameter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parameter'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parameters view large-9 medium-8 columns content">
    <h3><?= h($parameter->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Parameter') ?></th>
            <td><?= h($parameter->parameter) ?></td>
        </tr>
        <tr>
            <th><?= __('Constant') ?></th>
            <td><?= h($parameter->constant) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($parameter->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Set Id') ?></th>
            <td><?= $this->Number->format($parameter->set_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Logistics') ?></h4>
        <?php if (!empty($parameter->logistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Parameter Id') ?></th>
                <th><?= __('Event Id') ?></th>
                <th><?= __('Header') ?></th>
                <th><?= __('Text') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($parameter->logistics as $logistics): ?>
            <tr>
                <td><?= h($logistics->id) ?></td>
                <td><?= h($logistics->parameter_id) ?></td>
                <td><?= h($logistics->event_id) ?></td>
                <td><?= h($logistics->header) ?></td>
                <td><?= h($logistics->text) ?></td>
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
