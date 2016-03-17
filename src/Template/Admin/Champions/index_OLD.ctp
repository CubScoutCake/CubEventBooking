<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="champions index large-9 medium-8 columns content">
    <h3><?= __('Champions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('firstname') ?></th>
                <th><?= $this->Paginator->sort('lastname') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('district_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($champions as $champion): ?>
            <tr>
                <td><?= $this->Number->format($champion->id) ?></td>
                <td><?= h($champion->firstname) ?></td>
                <td><?= h($champion->lastname) ?></td>
                <td><?= h($champion->email) ?></td>
                <td><?= $champion->has('district') ? $this->Html->link($champion->district->district, ['controller' => 'Districts', 'action' => 'view', $champion->district->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $champion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $champion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $champion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champion->id)]) ?>
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
