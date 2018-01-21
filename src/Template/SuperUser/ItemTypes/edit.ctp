<div class="itemTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($itemType) ?>
    <fieldset>
        <legend><?= __('Edit Item Type') ?></legend>
        <?php
            echo $this->Form->input('item_type');
            echo $this->Form->input('role_id');
            echo $this->Form->input('minor');
            echo $this->Form->input('cancelled');
            echo $this->Form->input('available');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
