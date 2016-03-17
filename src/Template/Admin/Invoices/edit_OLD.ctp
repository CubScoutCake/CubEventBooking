<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_edit');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="invoices form large-9 medium-8 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Edit Invoice') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('application_id', ['options' => $applications]);
            echo $this->Form->input('value');
            echo $this->Form->input('paid');
            echo $this->Form->input('initialvalue');
            echo $this->Form->input('payments._ids', ['options' => $payments]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
