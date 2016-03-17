<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_add');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="champions form large-9 medium-8 columns content">
    <?= $this->Form->create($champion) ?>
    <fieldset>
        <legend><?= __('Add Champion') ?></legend>
        <?php
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('email');
            echo $this->Form->input('district_id', ['options' => $districts, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
