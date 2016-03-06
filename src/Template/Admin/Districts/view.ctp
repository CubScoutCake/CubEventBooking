<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_view');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="districts view large-9 medium-8 columns content">
    <h3><?= h($district->district) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('District') ?></th>
            <td><?= h($district->district) ?></td>
        </tr>
        <tr>
            <th><?= __('County') ?></th>
            <td><?= h($district->county) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($district->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Champions') ?></h4>
        <?php if (!empty($district->champions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Firstname') ?></th>
                <th><?= __('Lastname') ?></th>
                <th><?= __('Email') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($district->champions as $champions): ?>
            <tr>
                <td><?= h($champions->id) ?></td>
                <td><?= h($champions->firstname) ?></td>
                <td><?= h($champions->lastname) ?></td>
                <td><?= h($champions->email) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Champions', 'action' => 'view', $champions->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Champions', 'action' => 'edit', $champions->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Champions', 'action' => 'delete', $champions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champions->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Scoutgroups') ?></h4>
        <?php if (!empty($district->scoutgroups)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Scoutgroup') ?></th>
                <th><?= __('Number Stripped') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($district->scoutgroups as $scoutgroups): ?>
            <tr>
                <td><?= h($scoutgroups->id) ?></td>
                <td><?= h($scoutgroups->scoutgroup) ?></td>
                <td><?= h($scoutgroups->number_stripped) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Scoutgroups', 'action' => 'view', $scoutgroups->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Scoutgroups', 'action' => 'edit', $scoutgroups->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Scoutgroups', 'action' => 'delete', $scoutgroups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroups->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
