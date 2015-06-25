<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $allergy->allergy],
                ['confirm' => __('Are you sure you want to delete # {0}?', $allergy->allergy)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Allergies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Attendees'), ['controller' => 'Attendees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attendee'), ['controller' => 'Attendees', 'action' => 'add']) ?></li>
    </ul>
</div>
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
