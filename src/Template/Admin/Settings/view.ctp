<div class="settings view large-9 medium-8 columns content">
    <h3><?= h($setting->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($setting->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($setting->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Settingtype') ?></th>
            <td><?= $setting->has('settingtype') ? $this->Html->link($setting->settingtype->settingtype, ['controller' => 'Settingtypes', 'action' => 'view', $setting->settingtype->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($setting->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($setting->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($setting->modified) ?></tr>
        </tr>
    </table>
</div>
