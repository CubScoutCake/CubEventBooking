<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Logisticstypes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logisticstypes form large-9 medium-8 columns content">
    <?= $this->Form->create($logisticstype) ?>
    <fieldset>
        <legend><?= __('Add Logisticstype') ?></legend>
        <?php
            echo $this->Form->input('logistics_type');
            echo $this->Form->input('type_description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
