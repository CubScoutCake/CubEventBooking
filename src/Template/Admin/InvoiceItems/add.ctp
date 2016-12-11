<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_add');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="invoiceItems form large-10 medium-9 columns content">
    <?= $this->Form->create($invoiceItem) ?>
    <fieldset>
        <legend><?= __('Add Invoice Item') ?></legend>
        <?php
            echo $this->Form->input('invoice_id', ['options' => $invoices]);
            echo $this->Form->input('Value');
            echo $this->Form->input('Description');
            echo $this->Form->input('Quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
