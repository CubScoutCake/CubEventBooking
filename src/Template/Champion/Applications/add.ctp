<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/champion_add');
    echo $this->element('Sidebar/champion');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="applications form large-10 medium-9 columns">
    <?= $this->Form->create($application) ?>
    <fieldset>
        <legend><?= __('Add Application') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('scoutgroup_id');
            echo $this->Form->input('section');
            echo $this->Form->input('event_id',['options' => $events]);
            echo $this->Form->input('permitholder');
            echo $this->Form->input('attendees._ids', ['options' => $attendees]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
