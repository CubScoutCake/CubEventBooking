<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-cog fa-fw"></i> Settings</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th><?= $this->Paginator->sort('text') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('setting_type_id') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($settings as $setting): ?>
                    <tr>
                        <td><?= $this->Number->format($setting->id) ?></td>
                        <td><?= $this->Text->truncate($setting->name,18) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $setting->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $setting->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $this->Text->truncate($setting->text,18) ?></td>
                        <td><?= h($setting->created) ?></td>
                        <td><?= h($setting->modified) ?></td>
                        <td><?= $setting->has('setting_type') ? $this->Html->link($setting->setting_type->setting_type, ['controller' => 'SettingTypes', 'action' => 'view', $setting->setting_type->id]) : '' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>
