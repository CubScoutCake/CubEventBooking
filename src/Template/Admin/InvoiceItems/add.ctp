<<<<<<< HEAD
<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
>>>>>>> master
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_add');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<<<<<<< HEAD
<div class="invoiceItems form large-10 medium-9 columns content">
=======
<div class="invoiceItems form large-9 medium-8 columns content">
>>>>>>> master
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
