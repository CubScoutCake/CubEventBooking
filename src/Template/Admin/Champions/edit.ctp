<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $champion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $champion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Champions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Districts'), ['controller' => 'Districts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'Districts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="champions form large-10 medium-9 columns content">
    <?= $this->Form->create($champion) ?>
    <fieldset>
        <legend><?= __('Edit Champion') ?></legend>
        <?php
            echo $this->Form->input('district_id', ['options' => $districts]);
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
