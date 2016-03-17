<<<<<<< HEAD
<div class="invoiceItems form large-10 medium-9 columns content">
    <?= $this->Form->create($invPop); ?>
    <fieldset>
        <legend><?= __('Number of Attendees Being Registered') ?></legend>
        <?php
            if ($CubsVis == 1) { 
                echo $this->Form->input('cubs'); 
            }
            if ($YlsVis == 1) {
                echo $this->Form->input('yls'); 
            }
            if ($LeadersVis == 1) {
                echo $this->Form->input('leaders');
            }
=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>


<div class="invoiceItems form large-9 medium-9 columns content">
    <?= $this->Form->create($invPop); ?>
    <fieldset>
        <legend><?= __('Number of Leaders & DBS Adults') ?></legend>
        <?php
            echo $this->Form->input('cubs');
            echo $this->Form->input('yls');
            echo $this->Form->input('leaders');
>>>>>>> master
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>