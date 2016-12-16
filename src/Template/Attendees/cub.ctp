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
                    'minYear' => date('Y') - 20,
                    'maxYear' => date('Y') - 5,
                ]);
                echo $this->Form->input('phone', ['label' =>'Emergency Contact Number']);
                echo $this->Form->input('vegetarian');
                echo $this->Form->input('applications._ids', ['options' => $applications, 'multiple' => 'checkbox']);
                echo $this->Form->input('allergies._ids', ['options' => $allergies, 'multiple' => 'checkbox']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'),['class' => 'btn-success']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
