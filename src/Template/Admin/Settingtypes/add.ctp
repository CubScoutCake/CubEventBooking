<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Settingtypes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="settingtypes form large-9 medium-8 columns content">
    <?= $this->Form->create($settingtype) ?>
    <fieldset>
        <legend><?= __('Add Settingtype') ?></legend>
        <?php
            echo $this->Form->input('settingtype');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
