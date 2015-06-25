<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $attendee->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $attendee->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Attendees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Allergies'), ['controller' => 'Allergies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allergy'), ['controller' => 'Allergies', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="attendees form large-10 medium-9 columns">
    <?= $this->Form->create($attendee) ?>
    <fieldset>
        <legend><?= __('Edit Attendee') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('scoutgroup_id');
            echo $this->Form->input('role_id');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('dateofbirth');
            echo $this->Form->input('phone');
            echo $this->Form->input('phone2');
            echo $this->Form->input('address_1');
            echo $this->Form->input('address_2');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('postcode');
            echo $this->Form->input('nightsawaypermit');
            echo $this->Form->input('applications._ids', ['options' => $applications]);
            echo $this->Form->input('allergies._ids', ['options' => $allergies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
