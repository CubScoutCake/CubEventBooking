<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('role_id');
            echo $this->Form->input('scoutgroup_id');
            echo $this->Form->input('admin');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('phone');
            echo $this->Form->input('address_1');
            echo $this->Form->input('address_2');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('postcode');
            echo $this->Form->input('section');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
