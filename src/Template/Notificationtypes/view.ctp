<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notificationtype'), ['action' => 'edit', $notificationtype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notificationtype'), ['action' => 'delete', $notificationtype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notificationtype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notificationtypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notificationtype'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notificationtypes view large-9 medium-8 columns content">
    <h3><?= h($notificationtype->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Notification Type') ?></th>
            <td><?= h($notificationtype->notification_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Notification Description') ?></th>
            <td><?= h($notificationtype->notification_description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notificationtype->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Notifications') ?></h4>
        <?php if (!empty($notificationtype->notifications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Read') ?></th>
                <th><?= __('Text') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Read Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($notificationtype->notifications as $notifications): ?>
            <tr>
                <td><?= h($notifications->id) ?></td>
                <td><?= $notifications->new ? __('No') : __('Yes'); ?></td>
                <td><?= $this->Text->truncate($notifications->text,18) ?></td>
                <td><?= $this->Time->i18nFormat($notifications->created, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($notifications->read_date, 'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' => 'view', $notifications->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'action' => 'delete', $notifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notifications->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
