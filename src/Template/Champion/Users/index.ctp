<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/champion_index');
    echo $this->element('Sidebar/champion');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('scoutgroup_id') ?></th>
            <th><?= $this->Paginator->sort('role_id') ?></th>
            <th><?= $this->Paginator->sort('firstname') ?></th>
            <th><?= $this->Paginator->sort('lastname') ?></th>
            <th><?= $this->Paginator->sort('authrole') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= h($this->Text->truncate($user->username,18)) ?></td>
            <td><?= $user->has('scoutgroup') ? $this->Html->link($this->Text->truncate($user->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->id]) : '' ?></td>
            <td><?= $user->has('role') ? $this->Html->link($this->Text->truncate($user->role->role,18), ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
            <td><?= h($user->firstname) ?></td>
            <td><?= h($user->lastname) ?></td>
            <td><?= h($user->authrole) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
