<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>


<div class="invoiceItems form large-9 medium-8 columns content">
    <?= $this->Form->create($invPop); ?>
    <fieldset>
        <legend><?= __('Number of Leaders & DBS Adults') ?></legend>
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
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>
