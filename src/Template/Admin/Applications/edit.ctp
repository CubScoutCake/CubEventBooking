<?php
/**
 * @var \App\View\AppView $this
 *
 * @var array $users
 * @var array $sections
 * @var array $events
 *
 * @var bool $permitHolderBool
 * @var bool $teamLeaderBool
 */
?>
<div class="applications form large-10 medium-9 columns">
    <?= $this->Form->create($application) ?>
    <fieldset>
        <legend><?= __('Edit Application') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('section_id', ['options' => $sections]);
            echo $this->Form->control('event_id', ['options' => $events]);
            if ($permitHolderBool) {
                echo $this->Form->control('permit_holder', ['label' => 'The Name of the Nights Away Permit Holder']);
            }
            if ($teamLeaderBool) {
                echo $this->Form->control('team_leader', ['label' => 'The Name of the ' . $term . ' Leader' ]);
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
