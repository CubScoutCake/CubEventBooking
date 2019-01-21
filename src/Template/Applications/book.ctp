<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <?= $this->Form->create($application) ?>
            <fieldset>
                <legend><i class="fal fa-clipboard-list fa-fw" ></i><?= __(' Add Application') ?></legend>
                <?php
                    echo $this->Form->input('scoutgroup_id', ['options' => $scoutgroups]);
                    echo $this->Form->input('section', ['label' => 'Any Specific Section Name e.g. Wednesdays - Leave this blank if you are the only Cub Section in the Scout Group.']);
                    echo $this->Form->input('event_id');
                    echo $this->Form->input('permitholder', ['label' => 'The Name of the Permitholder (or Leader In Charge)']);
                    echo $this->Form->input('attendees._ids', ['options' => $attendees, 'label' => 'Associate Attendees - This will be blank if you have not created any attendees.', 'multiple' => 'checkbox']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'),['class' => 'btn-success']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
