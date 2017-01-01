<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Section Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sectionTypes index large-9 medium-8 columns content">
    <h3><?= __('Section Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('section_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('upper_age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lower_age') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sectionTypes as $sectionType): ?>
            <tr>
                <td><?= $this->Number->format($sectionType->id) ?></td>
                <td><?= h($sectionType->section_type) ?></td>
                <td><?= $this->Number->format($sectionType->upper_age) ?></td>
                <td><?= $this->Number->format($sectionType->lower_age) ?></td>
                <td><?= $sectionType->has('role') ? $this->Html->link($sectionType->role->role, ['controller' => 'Roles', 'action' => 'view', $sectionType->role->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sectionType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sectionType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sectionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sectionType->id)]) ?>
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
