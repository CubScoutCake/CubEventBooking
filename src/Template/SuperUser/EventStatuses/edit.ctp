<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventStatus $eventStatus
 */
?>
<div class="eventStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($eventStatus) ?>
    <fieldset>
        <legend><?= __('Edit Event Status') ?></legend>
        <?php
            echo $this->Form->control('event_status');
            echo $this->Form->control('live');
            echo $this->Form->control('accepting_applications');
            echo $this->Form->control('spaces_full');
            echo $this->Form->control('pending_date');
            echo $this->Form->control('status_order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
