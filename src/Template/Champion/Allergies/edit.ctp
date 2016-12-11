<div class="allergies form large-10 medium-9 columns">
    <?= $this->Form->create($allergy) ?>
    <fieldset>
        <legend><?= __('Edit Allergy') ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('description');
            echo $this->Form->input('attendees._ids', ['options' => $attendees]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
