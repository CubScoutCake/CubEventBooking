<div class="applications form large-10 medium-9 columns">
    <?= $this->Form->create($application) ?>
    <fieldset>
        <legend><?= __('Add Application') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('section_id', ['options' => $sections]);
            echo $this->Form->input('event_id',['options' => $events]);
            echo $this->Form->input('permit_holder');
            echo $this->Form->input('team_leader');
            echo $this->Form->input('attendees._ids', ['options' => $attendees, 'multiple' => 'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
