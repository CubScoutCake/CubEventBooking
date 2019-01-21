<div class="discounts form large-9 medium-8 columns content">
    <?= $this->Form->create($discount) ?>
    <fieldset>
        <legend><?= __('Edit Discount') ?></legend>
        <?php
            echo $this->Form->input('discount');
            echo $this->Form->input('code');
            echo $this->Form->input('text');
            echo $this->Form->input('active');
            echo $this->Form->input('discount_value');
            echo $this->Form->input('discount_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
