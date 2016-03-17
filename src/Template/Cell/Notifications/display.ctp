<<<<<<< HEAD
<?php foreach ($notifications as $notification): ?>
    <li>
        <a href="<?php echo $this->Url->build([
                        'controller' => 'Notifications',
                        'action' => 'view',
                        'prefix' => false,
                        $notification->id]); ?>">
            <div>
                <i class="fa <?= $notification->has('notificationtype') ? h($notification->notificationtype->icon) : '' ?> fa-fw"></i> <?= $notification->has('notificationtype') ? h($notification->notificationtype->notification_type) : '' ?>
                <span class="pull-right text-muted small"><?= $this->Time->i18nFormat($notification->created, 'dd-MMM-yy HH:mm') ?></span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
<?php endforeach; ?>
=======
<?php
if ($unread_count > 0) {
    $class = 'message';
} else {
	$class = 'notification-icon';
}
?>

<div class="<?= h($class) ?>">
    You have <?= $unread_count ?> <?= $this->Html->link('unread',['controller' => 'Notifications', 'action' => 'unread']) ?> <?= $this->Html->link('notifications.',['controller' => 'Notifications', 'action' => 'index']) ?>
</div>
>>>>>>> master
