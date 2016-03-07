<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="scoutgroups index large-9 medium-8 columns content">
    <h3><?= __('Scoutgroups') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('scoutgroup') ?></th>
                <th><?= $this->Paginator->sort('district_id') ?></th>
                <th><?= $this->Paginator->sort('number_stripped') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scoutgroups as $scoutgroup): ?>
            <tr>
                <td><?= h($scoutgroup->scoutgroup) ?></td>
                <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
                <td><?= $this->Number->format($scoutgroup->number_stripped) ?></td>
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
