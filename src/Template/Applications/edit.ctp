<?php
/**
 * @var \App\Model\Entity\Application $application
 * @var array $sections
 * @var array $events
 * @var array $attendees
 */
?>
<div class="applications form large-9 medium-8 columns content">
    <?= $this->Form->create($application) ?>
    <fieldset>
        <legend><?= __('Edit Application') ?></legend>
        <?php
            echo $this->Form->input('section', ['options' => $sections]);

            if ($permitHolderBool) {
                echo $this->Form->input('permit_holder', ['label' => 'The Name of the Nights Away Permit Holder']);
            }
            if ($teamLeaderBool) {
                echo $this->Form->input('team_leader', ['label' => 'The Name of the ' . $term . ' Leader' ]);
            }

            echo $this->Form->input('attendees._ids', ['options' => $attendees, 'label' => 'Associate Attendees - This will be blank if you have not created any attendees.', 'multiple' => 'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
