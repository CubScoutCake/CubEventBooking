<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Application'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="applications index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('scoutgroup_id') ?></th>
            <th><?= $this->Paginator->sort('section') ?></th>
            <th><?= $this->Paginator->sort('permitholder') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($applications as $application): ?>
        <tr>
            <td><?= $this->Number->format($application->id) ?></td>
            <td>
                <?= $application->has('user') ? $this->Html->link($application->user->id, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($application->scoutgroup_id) ?></td>
            <td><?= h($application->section) ?></td>
            <td><?= $this->Number->format($application->permitholder) ?></td>
            <td><?= h($application->created) ?></td>
            <td><?= h($application->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
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
