<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Allergy'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="allergies index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('allergy') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($allergies as $allergy): ?>
        <tr>
            <td><?= $this->Number->format($allergy->id) ?></td>
            <td><?= h($allergy->allergy) ?></td>
            <td><?= h($allergy->description) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $allergy->allergy]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $allergy->allergy]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $allergy->allergy], ['confirm' => __('Are you sure you want to delete # {0}?', $allergy->allergy)]) ?>
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
