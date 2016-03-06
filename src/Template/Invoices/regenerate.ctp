<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="invoices form large-10 medium-9 columns">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Regenerate Invoice') ?></legend>
        <?php
            echo $this->Form->input('application_id', ['options' => $applications]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
