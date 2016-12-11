<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Settingtype'), ['action' => 'edit', $settingtype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Settingtype'), ['action' => 'delete', $settingtype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $settingtype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Settingtypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Settingtype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="settingtypes view large-9 medium-8 columns content">
    <h3><?= h($settingtype->settingtype) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Settingtype') ?></th>
            <td><?= h($settingtype->settingtype) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($settingtype->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($settingtype->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Settings') ?></h4>
        <?php if (!empty($settingtype->settings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Text') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Settingtype Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($settingtype->settings as $settings): ?>
            <tr>
                <td><?= h($settings->id) ?></td>
                <td><?= h($settings->name) ?></td>
                <td><?= h($settings->text) ?></td>
                <td><?= h($settings->created) ?></td>
                <td><?= h($settings->modified) ?></td>
                <td><?= h($settings->settingtype_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Settings', 'action' => 'view', $settings->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Settings', 'action' => 'edit', $settings->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Settings', 'action' => 'delete', $settings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $settings->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
