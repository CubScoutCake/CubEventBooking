<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <h3 class="heading"><?= __('Actions') ?></h3>
        <li><?= $this->Html->link(__('All Your Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Your Unread Notifications'), ['action' => 'unread']) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete notification # {0}?', $notification->id)]) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="notifications view large-10 medium-9 columns content">
    <h3><?= h($notification->notification_header) ?></h3>
    </br>
    <table class="vertical-table">
        <!-- <tr>
            <td><?= h($notification->text) ?></td>
        </tr> -->
        <tr>
            <th><?= $this->Html->link('View Notification Subject', ['controller' => $notification->link_controller, 'action' => $notification->link_action, 'prefix' => false, $notification->link_id]) ?></th>
        </tr>
    </table>
    <p><?= h($notification->text) ?></p>
    
    </br>
    <!-- </br> -->
    <table class="vertical-table">
        <tr>
            <th><?= __('Notification Source') ?></th>
            <td><?= h($notification->notification_source) ?></td>
        </tr>
        <tr>
            <th><?= __('Unique Notification Id') ?></th>
            <td><?= $this->Number->format($notification->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Date Created') ?></th>
            <td><?= h($notification->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Read Date') ?></th>
            <td><?= h($notification->read_date) ?></td>
        </tr>
    </table>
</div>
