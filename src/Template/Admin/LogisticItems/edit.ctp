<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $logisticItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $logisticItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistics'), ['controller' => 'Logistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic'), ['controller' => 'Logistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Params'), ['controller' => 'Params', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Param'), ['controller' => 'Params', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="logisticItems form large-9 medium-8 columns content">
    <?= $this->Form->create($logisticItem) ?>
    <fieldset>
        <legend><?= __('Edit Logistic Item') ?></legend>
        <?php
            echo $this->Form->input('application_id', ['options' => $applications, 'empty' => true]);
            echo $this->Form->input('logistic_id', ['options' => $logistics, 'empty' => true]);
            echo $this->Form->input('param_id', ['options' => $params, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
