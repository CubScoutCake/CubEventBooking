<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Scoutgroups'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="scoutgroups form large-10 medium-9 columns">
    <?= $this->Form->create($scoutgroup) ?>
    <fieldset>
        <legend><?= __('Add Scoutgroup') ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('district_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
