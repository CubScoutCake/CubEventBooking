<div class="itemTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($itemType) ?>
    <fieldset>
        <legend><?= __('Edit Item Type') ?></legend>
        <?php
            echo $this->Form->control('item_type');
            echo $this->Form->control('role_id', ['options' => $roles, 'empty' => true]);
            echo $this->Form->control('minor');
            echo $this->Form->control('cancelled');
            echo $this->Form->control('available');
            echo $this->Form->control('team_price');
            echo $this->Form->control('deposit');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
