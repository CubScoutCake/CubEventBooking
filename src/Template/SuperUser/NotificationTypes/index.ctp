<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-flag-checkered fa-fw"></i> Notification Types</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('icon') ?></th>
                    <th><?= $this->Paginator->sort('notification_type') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th><?= $this->Paginator->sort('notification_description') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($notificationTypes as $notification_type): ?>
                    <tr>
                        <td><?= $this->Number->format($notification_type->id) ?></td>
                        <td><i class="fal <?= $notification_type->icon ?> fa-fw fa-2x"></i></td>
                        <td><?= h($notification_type->notification_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $notification_type->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $notification_type->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $notification_type->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification_type->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= h($notification_type->notification_description) ?></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
