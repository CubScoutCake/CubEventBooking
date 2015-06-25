<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Scoutgroup'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="scoutgroups index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('scoutgroup') ?></th>
            <th><?= $this->Paginator->sort('district_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($scoutgroups as $scoutgroup): ?>
        <tr>
            <td><?= $this->Number->format($scoutgroup->id) ?></td>
            <td><?= h($scoutgroup->scoutgroup) ?></td>
            <td><?= $this->Number->format($scoutgroup->district_id) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $scoutgroup->scoutgroup]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $scoutgroup->scoutgroup]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $scoutgroup->scoutgroup], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroup->scoutgroup)]) ?>
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
