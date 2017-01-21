<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Item Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Invoice Items'), ['controller' => 'InvoiceItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['controller' => 'InvoiceItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
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
