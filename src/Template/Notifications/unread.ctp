<?= $this->assign('title', 'Your Unread Notifications'); ?>
<div class="notifications index large-10 medium-9 columns content">
    <h3><?= __('Notifications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('notification_type_id', 'Type') ?></th>
                <th><?= $this->Paginator->sort('new', 'Read') ?></th>
                <th><?= $this->Paginator->sort('notification_header', 'Header') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach ($notifications as $notification): ?>
            <tr>
                <td><?= $this->Number->format($notification->id) ?></td>
                <td><?= $notification->has('user') ? $this->Html->link($notification->user->full_name, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
                <td><?= $notification->has('notification_type') ? $this->Html->link($notification->notification_type->notification_type, ['controller' => 'NotificationTypes', 'action' => 'view', $notification->notification_type->id]) : '' ?></td>
                <td><?= $notification->new ? __('No') : __('Yes'); ?></td>
                <td><?= h($notification->notification_header) ?></td>
                <td><?= h($notification->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'prefix' => false, 'action' => 'view', $notification->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'prefix' => false, 'action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?>
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
