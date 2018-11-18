<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-bell fa-fw"></i> All Notifications</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('new', 'Read') ?></th>
                        <th><?= $this->Paginator->sort('notification_type_id', 'Type') ?></th>
                        <th><?= $this->Paginator->sort('user_id', 'User') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($notifications as $notification): ?>
                    <tr <?= $notification->new ? __('class="info"') : __(''); ?>>
                        <td><?= $this->Number->format($notification->id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $notification->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $notification->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $notification->new ? '' : '<i class="fal fa-check fa-fw"></i>' ?></td>
                        <td><?= $notification->has('notification_type') ? $this->Html->link($notification->notification_type->notification_type, ['prefix' => 'super_user', 'controller' => 'NotificationTypes', 'action' => 'view', $notification->notification_type->id]) : '' ?></td>
                        <td><?= $notification->has('user') ? $this->Html->link($this->Text->truncate($notification->user->full_name,20), ['prefix' => 'super_user', 'controller' => 'Users', 'action' => 'view', $notification->user_id]) : '' ?></td>
                        <td><?= $this->Time->i18nformat($notification->created,'dd-MMM-yy HH:mm') ?></td>
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
