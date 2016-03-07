<div class="actions columns large-2 medium-3">
<h3><?= __('Actions') ?></h3>
<ul class="side-nav">
    <li><?= $this->Html->link(__('New Young Person'), ['action' => 'cub']) ?></li>
    <li><?= $this->Html->link(__('New Adult'), ['action' => 'adult']) ?></li>
</ul>

<?= $this->start('Sidebar');
echo $this->element('Sidebar/user');
$this->end(); ?>

<?= $this->fetch('Sidebar') ?>

</div>
<div class="attendees index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('firstname') ?></th>
            <th><?= $this->Paginator->sort('lastname') ?></th>
            <th><?= $this->Paginator->sort('scoutgroup_id', 'Scout Group') ?></th>
            <th><?= $this->Paginator->sort('role_id', 'Role Type') ?></th>
            <th><?= $this->Paginator->sort('dateofbirth', 'D.O.B.') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($attendees as $attendee): ?>
        <tr>
            <td><?= $this->Number->format($attendee->id) ?></td>
            <td><?= h($attendee->firstname) ?></td>
            <td><?= h($attendee->lastname) ?></td>
            <td><?= $attendee->has('scoutgroup') ? $this->Html->link($attendee->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $attendee->scoutgroup->id]) : '' ?></td>
            <td><?= $attendee->has('role') ? $this->Html->link($attendee->role->role, ['controller' => 'Roles', 'action' => 'view', $attendee->role->id]) : '' ?></td>
            <td><?= $this->Time->i18nformat($attendee->dateofbirth,'dd-MMM-yyyy') ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $attendee->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendee->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendee->id)]) ?>
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
