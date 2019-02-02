<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <h3 class="heading"><?= __('Actions') ?></h3>
        <li><?= $this->Html->link(__('All Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Unread Notifications'), ['action' => 'unread']) ?> </li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="notifications form large-10 medium-9 columns content">
    <?= $this->Form->create($notification) ?>
    <fieldset>
        <legend><?= __('Add Notification') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('notification_type_id', ['options' => $notification_types, 'empty' => true]);
            echo $this->Form->input('new');
            echo $this->Form->input('notification_header');
            echo $this->Form->input('text');
            echo $this->Form->input('read_date');
            echo $this->Form->input('notification_source');
            echo $this->Form->input('link_id');
            echo $this->Form->input('link_controller');
            echo $this->Form->input('link_prefix');
            echo $this->Form->input('link_action');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
