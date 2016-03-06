<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/champion_add');
    echo $this->element('Sidebar/champion');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="scoutgroups form large-9 medium-8 columns content">
    <?= $this->Form->create($scoutgroup) ?>
    <fieldset>
        <legend><?= __('Add Scoutgroup') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup');
            echo $this->Form->input('number_stripped');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
