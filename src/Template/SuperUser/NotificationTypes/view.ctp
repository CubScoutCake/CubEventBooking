<div class="notification_types view large-10 medium-9 columns content">
    <h3><?= h($notification_type->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Notification Type') ?></th>
            <td><?= h($notification_type->notification_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Notification Description') ?></th>
            <td><?= h($notification_type->notification_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notification_type->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Notifications') ?></h4>
        <?php if (!empty($notification_type->notifications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Notification Type Id') ?></th>
                <th><?= __('New') ?></th>
                <th><?= __('Header') ?></th>
                <th><?= __('Text') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Read Date') ?></th>
                <th><?= __('From') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($notification_type->notifications as $notifications): ?>
            <tr>
                <td><?= h($notifications->id) ?></td>
                <td><?= h($notifications->user_id) ?></td>
                <td><?= h($notifications->notification_type_id) ?></td>
                <td><?= h($notifications->new) ?></td>
                <td><?= h($notifications->header) ?></td>
                <td><?= h($notifications->text) ?></td>
                <td><?= h($notifications->created) ?></td>
                <td><?= h($notifications->read_date) ?></td>
                <td><?= h($notifications->from) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' => 'view', $notifications->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'action' => 'edit', $notifications->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'action' => 'delete', $notifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notifications->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
