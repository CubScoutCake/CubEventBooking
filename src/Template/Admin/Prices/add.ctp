<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Prices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Item Types'), ['controller' => 'ItemTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Type'), ['controller' => 'ItemTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prices form large-9 medium-8 columns content">
    <?= $this->Form->create($price) ?>
    <fieldset>
        <legend><?= __('Add Price') ?></legend>
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
