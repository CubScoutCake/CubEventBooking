<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/locked');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="attendees form large-10 medium-9 columns">
    <?= $this->Form->create($attendee) ?>
    <fieldset>
        <legend><?= __('Add a new Young Person') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup_id');
            echo $this->Form->input('role_id');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->label('dateofbirth', 'Date of Birth');
            echo $this->Form->day('dateofbirth');
            echo $this->Form->month('dateofbirth');
            echo $this->Form->year('dateofbirth', [
                'minYear' => 1950,
                'maxYear' => date('Y')
            ]);
            echo $this->Form->input('applications._ids', ['options' => $applications]);
            echo $this->Form->input('allergies._ids', ['options' => $allergies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
