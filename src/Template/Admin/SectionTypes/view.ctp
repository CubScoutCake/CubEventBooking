<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Section Type'), ['action' => 'edit', $sectionType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Section Type'), ['action' => 'delete', $sectionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sectionType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Section Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sectionTypes view large-9 medium-8 columns content">
    <h3><?= h($sectionType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Section Type') ?></th>
            <td><?= h($sectionType->section_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $sectionType->has('role') ? $this->Html->link($sectionType->role->role, ['controller' => 'Roles', 'action' => 'view', $sectionType->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sectionType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Upper Age') ?></th>
            <td><?= $this->Number->format($sectionType->upper_age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lower Age') ?></th>
            <td><?= $this->Number->format($sectionType->lower_age) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sections') ?></h4>
        <?php if (!empty($sectionType->sections)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Section') ?></th>
                <th scope="col"><?= __('Section Type Id') ?></th>
                <th scope="col"><?= __('Scoutgroup Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($sectionType->sections as $sections): ?>
            <tr>
                <td><?= h($sections->id) ?></td>
                <td><?= h($sections->created) ?></td>
                <td><?= h($sections->modified) ?></td>
                <td><?= h($sections->deleted) ?></td>
                <td><?= h($sections->section) ?></td>
                <td><?= h($sections->section_type_id) ?></td>
                <td><?= h($sections->scoutgroup_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sections', 'action' => 'view', $sections->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sections', 'action' => 'edit', $sections->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sections', 'action' => 'delete', $sections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sections->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
