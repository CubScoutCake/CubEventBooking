<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notificationtypes'), ['controller' => 'Notificationtypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notificationtype'), ['controller' => 'Notificationtypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notifications view large-9 medium-8 columns content">
    <h3><?= h($notification->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $notification->has('user') ? $this->Html->link($notification->user->full_name, ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Notificationtype') ?></th>
            <td><?= $notification->has('notificationtype') ? $this->Html->link($notification->notificationtype->id, ['controller' => 'Notificationtypes', 'action' => 'view', $notification->notificationtype->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Notification Header') ?></th>
            <td><?= h($notification->notification_header) ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($notification->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Notification Source') ?></th>
            <td><?= h($notification->notification_source) ?></td>
        </tr>
        <tr>
            <th><?= __('Link Controller') ?></th>
            <td><?= h($notification->link_controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Link Prefix') ?></th>
            <td><?= h($notification->link_prefix) ?></td>
        </tr>
        <tr>
            <th><?= __('Link Action') ?></th>
            <td><?= h($notification->link_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($notification->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Link Id') ?></th>
            <td><?= $this->Number->format($notification->link_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($notification->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Read Date') ?></th>
            <td><?= h($notification->read_date) ?></td>
        </tr>
    </table>
</div>
