<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_add');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="scoutgroups form large-10 medium-9 columns content">
    <?= $this->Form->create($scoutgroup) ?>
    <fieldset>
        <legend><?= __('Add Scoutgroup') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup');
            echo $this->Form->input('district_id', ['options' => $districts]);
            echo $this->Form->input('number_stripped');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
