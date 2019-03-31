<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Task Types'), ['controller' => 'TaskTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task Type'), ['controller' => 'TaskTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tasks form large-9 medium-8 columns content">
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend><?= __('Edit Task') ?></legend>
        <?php
            echo $this->Form->control('task_type_id', ['options' => $taskTypes]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('completed');
            echo $this->Form->control('date_completed');
            echo $this->Form->control('completed_by_user_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
