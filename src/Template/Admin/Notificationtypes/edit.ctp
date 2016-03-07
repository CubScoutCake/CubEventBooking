<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $notificationtype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $notificationtype->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Notificationtypes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notificationtypes form large-9 medium-8 columns content">
    <?= $this->Form->create($notificationtype) ?>
    <fieldset>
        <legend><?= __('Edit Notificationtype') ?></legend>
        <?php
            echo $this->Form->input('notification_type');
            echo $this->Form->input('notification_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
