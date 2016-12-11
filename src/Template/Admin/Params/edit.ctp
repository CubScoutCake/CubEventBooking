<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $param->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $param->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Params'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logistic Items'), ['controller' => 'LogisticItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Logistic Item'), ['controller' => 'LogisticItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="params form large-9 medium-8 columns content">
    <?= $this->Form->create($param) ?>
    <fieldset>
        <legend><?= __('Edit Param') ?></legend>
        <?php
            echo $this->Form->input('parameter_id', ['options' => $parameters, 'empty' => true]);
            echo $this->Form->input('constant');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
