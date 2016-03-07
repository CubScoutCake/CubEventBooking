<nav class="actions large-2 medium-2 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_edit');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="payments form large-10 medium-10 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Edit Payment') ?></legend>
        <?php
            echo $this->Form->input('value');
            echo $this->Form->input('paid');
            echo $this->Form->input('cheque_number');
            echo $this->Form->input('name_on_cheque');
            echo $this->Form->input('invoices._ids', ['options' => $invoices]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
