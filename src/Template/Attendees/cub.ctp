<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <?= $this->Form->create($attendee) ?>
        <fieldset>
            <legend><i class="fa fa-group fa-fw"></i><?= __(' Add a New Young Person') ?></legend>
            <?php
                echo $this->Form->input('scoutgroup_id');
                echo $this->Form->input('role_id');
                echo $this->Form->input('firstname');
                echo $this->Form->input('lastname');
                echo $this->Form->input('dateofbirth', [
                    'label' => 'Date of birth',
                    'minYear' => date('Y') - 85,
                    'maxYear' => date('Y') - 5,
                ]);
                echo $this->Form->input('phone', ['label' =>'Emergency Contact Number']);
                echo $this->Form->input('applications._ids', ['options' => $applications, 'multiple' => 'checkbox']);
                echo $this->Form->input('allergies._ids', ['options' => $allergies, 'multiple' => 'checkbox']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'),['class' => 'btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
=======
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
>>>>>>> master
</div>
