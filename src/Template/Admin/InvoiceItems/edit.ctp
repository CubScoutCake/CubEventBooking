<div class="invoiceItems form large-9 medium-8 columns content">
    <?= $this->Form->create($invoiceItem) ?>
    <fieldset>
        <legend><?= __('Edit Invoice Item') ?></legend>
        <?php
            echo $this->Form->input('Description', ['disabled' => true]);
            echo $this->Form->input('Value');

            echo $this->Form->input('Quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
