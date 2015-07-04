<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New District'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scoutgroups'), ['controller' => 'Scoutgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scoutgroup'), ['controller' => 'Scoutgroups', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="districts index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('district') ?></th>
            <th><?= $this->Paginator->sort('county') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($districts as $district): ?>
        <tr>
            <td><?= $this->Number->format($district->id) ?></td>
            <td><?= h($district->district) ?></td>
            <td><?= h($district->county) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $district->district]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $district->district]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $district->district], ['confirm' => __('Are you sure you want to delete # {0}?', $district->district)]) ?>
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
