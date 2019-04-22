<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationStatus $applicationStatus
 */
?>
<div class="applicationStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($applicationStatus) ?>
    <fieldset>
        <legend><?= __('Add Application Status') ?></legend>
        <?php
            echo $this->Form->control('application_status');
            echo $this->Form->control('active');
            echo $this->Form->control('no_money');
            echo $this->Form->control('reserved');
            echo $this->Form->control('attendees_added');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
