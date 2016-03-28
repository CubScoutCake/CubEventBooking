<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="attendees form large-10 medium-9 columns">
    <?= $this->Form->create($attendee) ?>
    <fieldset>
        <legend><?= __('Edit Attendee') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup_id');
            echo $this->Form->input('role_id');
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->label('dateofbirth', 'Date of Birth');
            echo $this->Form->day('dateofbirth');
            echo $this->Form->month('dateofbirth');
            echo $this->Form->year('dateofbirth', [
                'minYear' => 1930,
                'maxYear' => date('Y')
            ]);
            echo $this->Form->input('phone');
            echo $this->Form->input('phone2');
            echo $this->Form->input('address_1');
            echo $this->Form->input('address_2');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('postcode');
            echo $this->Form->input('nightsawaypermit');
            echo $this->Form->input('applications._ids', ['options' => $applications, 'multiple' => 'checkbox']);
            echo $this->Form->input('allergies._ids', ['options' => $allergies, 'multiple' => 'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
