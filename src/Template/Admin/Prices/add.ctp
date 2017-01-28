<div class="prices form large-9 medium-8 columns content">
    <?= $this->Form->create($price) ?>
    <fieldset>
        <legend><?= __('Add Price') ?></legend>
        <?php
            echo '<div class="row"> <div class="col-lg-6">';
            echo $this->Form->input('item_type_id', ['options' => $itemTypes, 'empty' => true]);
            echo $this->Form->input('max_number');

            echo '</div> <div class="col-lg-6">';
            echo $this->Form->input('event_id', ['options' => $events]);
            echo $this->Form->input('value');
            echo '</div> </div>';

            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
