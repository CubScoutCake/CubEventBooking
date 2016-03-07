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