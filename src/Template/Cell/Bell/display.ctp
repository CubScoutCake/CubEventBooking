<?php foreach ($notifications as $notification): ?>
    <li>
        <a href="<?php echo $this->Url->build([
                        'controller' => 'Notifications',
                        'action' => 'view',
                        'prefix' => false,
                        $notification->id]); ?>">
            <div>
                <i class="fal <?= $notification->has('notification_type') ? h($notification->notification_type->icon) : '' ?> fa-fw"></i> <?= $notification->has('notification_type') ? h($notification->notification_type->notification_type) : '' ?>
                <span class="pull-right text-muted small"><?= $this->Time->i18nFormat($notification->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></span>
            </div>
        </a>
    </li>
    <li class="divider"></li>
<?php endforeach; ?>