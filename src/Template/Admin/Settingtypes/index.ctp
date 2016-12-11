<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Settingtype'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="settingtypes index large-9 medium-8 columns content">
    <h3><?= __('Settingtypes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('settingtype') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($settingtypes as $settingtype): ?>
            <tr>
                <td><?= $this->Number->format($settingtype->id) ?></td>
                <td><?= h($settingtype->settingtype) ?></td>
                <td><?= h($settingtype->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $settingtype->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $settingtype->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $settingtype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $settingtype->id)]) ?>
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
