<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="applications form large-9 medium-8 columns content">
    <?= $this->Form->create($application) ?>
    <fieldset>
        <legend><?= __('Edit Application') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup_id', ['options' => $scoutgroups]);
            echo $this->Form->input('section', ['label' => 'Any Specific Section Name e.g. Wednesdays - Leave this blank if you are the only Cub Section in the Scout Group.']);
            echo $this->Form->input('event_id', ['options' => $events]);
            echo $this->Form->input('permitholder');
<<<<<<< HEAD
            echo $this->Form->input('attendees._ids', ['options' => $attendees, 'label' => 'Associate Attendees - This will be blank if you have not created any attendees.', 'multiple' => 'checkbox']);
=======
            echo $this->Form->input('attendees._ids', ['options' => $attendees, 'label' => 'Associate Attendees - This will be blank if you have not created any attendees.']);
>>>>>>> master
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
