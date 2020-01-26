<div class="invoices form large-10 medium-9 columns content">
    <?= $this->Form->create($invoice) ?>
    <fieldset>
        <legend><?= __('Add Invoice') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('application_id', ['options' => $applications, 'empty' => true]);
            echo $this->Form->input('value');
            echo $this->Form->input('paid');
            echo $this->Form->input('initial_value');
            echo $this->Form->input('payments._ids', ['options' => $payments]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
