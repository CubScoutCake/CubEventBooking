<div class="row">
    <div class="col-lg-12">
        <?= $this->Form->create($attendee) ?>
        <fieldset>
            <legend><i class="fa fa-group fa-fw"></i><?= __(' Add a New Adult') ?></legend>
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
                echo $this->Form->input('vegetarian');
                echo $this->Form->input('nightsawaypermit');
                echo $this->Form->input('applications._ids', ['options' => $applications, 'multiple' => 'checkbox']);
                echo $this->Form->input('allergies._ids', ['options' => $allergies, 'multiple' => 'checkbox']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
