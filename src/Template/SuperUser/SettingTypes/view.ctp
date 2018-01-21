<div class="settingTypes view large-9 medium-8 columns content">
    <h3><?= h($settingType->setting_type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Setting Type') ?></th>
            <td><?= h($settingType->setting_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($settingType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($settingType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Min Auth') ?></th>
            <td><?= $this->Number->format($settingType->min_auth) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Settings') ?></h4>
        <?php if (!empty($settingType->settings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Text') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Setting Type Id') ?></th>
                <th scope="col"><?= __('Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($settingType->settings as $settings): ?>
            <tr>
                <td><?= h($settings->id) ?></td>
                <td><?= h($settings->name) ?></td>
                <td><?= h($settings->text) ?></td>
                <td><?= h($settings->created) ?></td>
                <td><?= h($settings->modified) ?></td>
                <td><?= h($settings->event_id) ?></td>
                <td><?= h($settings->setting_type_id) ?></td>
                <td><?= h($settings->number) ?></td>
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
