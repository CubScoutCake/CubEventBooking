<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="scoutgroups index large-10 medium-9 columns content">
    <h3><?= __('Scoutgroups') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('scoutgroup') ?></th>
                <th><?= $this->Paginator->sort('district_id') ?></th>
                <th><?= $this->Paginator->sort('number_stripped') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scoutgroups as $scoutgroup): ?>
            <tr>
                <td><?= $this->Number->format($scoutgroup->id) ?></td>
                <td><?= h($scoutgroup->scoutgroup) ?></td>
                <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
                <td><?= $this->Number->format($scoutgroup->number_stripped) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $scoutgroup->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $scoutgroup->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $scoutgroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroup->id)]) ?>
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