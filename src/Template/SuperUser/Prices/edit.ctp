<div class="prices form large-9 medium-8 columns content">
    <?= $this->Form->create($price) ?>
    <fieldset>
        <legend><?= __('Edit Price') ?></legend>
        <?php
            echo $this->Form->input('item_type_id', ['options' => $itemTypes, 'empty' => true]);
            echo $this->Form->input('event_id', ['options' => $events]);
            echo $this->Form->input('max_number');
            echo $this->Form->input('value');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
