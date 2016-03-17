<<<<<<< HEAD
<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
>>>>>>> master
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_edit');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<<<<<<< HEAD
<div class="scoutgroups form large-10 medium-9 columns content">
=======
<div class="scoutgroups form large-9 medium-8 columns content">
>>>>>>> master
    <?= $this->Form->create($scoutgroup) ?>
    <fieldset>
        <legend><?= __('Edit Scoutgroup') ?></legend>
        <?php
            echo $this->Form->input('scoutgroup');
            echo $this->Form->input('district_id', ['options' => $districts]);
            echo $this->Form->input('number_stripped');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
