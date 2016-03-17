<<<<<<< HEAD
=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Settings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Settingtypes'), ['controller' => 'Settingtypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Settingtype'), ['controller' => 'Settingtypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
>>>>>>> master
<div class="settings form large-9 medium-8 columns content">
    <?= $this->Form->create($setting) ?>
    <fieldset>
        <legend><?= __('Add Setting') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('text');
            echo $this->Form->input('settingtype_id', ['options' => $settingtypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
