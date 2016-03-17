<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/champion_edit');
    echo $this->element('Sidebar/champion');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="events form large-9 medium-8 columns content">
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Edit Event') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('full_name');
            echo $this->Form->input('start');
            echo $this->Form->input('end');
            echo $this->Form->input('deposit');
            echo $this->Form->input('deposit_date');
            echo $this->Form->input('deposit_value');
            echo $this->Form->input('deposit_inc_leaders');
            echo $this->Form->input('deposit_text');
            echo $this->Form->input('cubs');
            echo $this->Form->input('cubs_value');
            echo $this->Form->input('cubs_text');
            echo $this->Form->input('yls');
            echo $this->Form->input('yls_value');
            echo $this->Form->input('yls_text');
            echo $this->Form->input('leaders');
            echo $this->Form->input('leaders_value');
            echo $this->Form->input('leaders_text');
            echo $this->Form->input('address1');
            echo $this->Form->input('address2');
            echo $this->Form->input('city');
            echo $this->Form->input('county');
            echo $this->Form->input('postcode');
            echo $this->Form->input('invCode');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
