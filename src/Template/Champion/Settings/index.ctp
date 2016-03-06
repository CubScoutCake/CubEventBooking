<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="settings index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Id') ?></th>
            <th><?= $this->Paginator->sort('Name') ?></th>
            <th><?= $this->Paginator->sort('Text') ?></th>
            <th><?= $this->Paginator->sort('Event Id') ?></th>
            <th><?= $this->Paginator->sort('Created') ?></th>
            <th><?= $this->Paginator->sort('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($settings as $setting): ?>
        <tr>
            <td><?= $this->Number->format($setting->id) ?></td>
            <td><?= h($setting->name) ?></td>
            <td><?= $this->Text->truncate($setting->text,18) ?></td>
            <td><?= $this->Number->format($setting->event_id) ?></td>
            <td><?= $this->Time->i18nformat($setting->created,'dd-MMM-yy HH:mm') ?></td>
            <td><?= $this->Time->i18nformat($setting->modified,'dd-MMM-yy HH:mm') ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $setting->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $setting->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?>
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
