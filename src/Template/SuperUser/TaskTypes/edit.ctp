<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskType $taskType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $taskType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $taskType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Task Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="taskTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($taskType) ?>
    <fieldset>
        <legend><?= __('Edit Task Type') ?></legend>
        <?php
            echo $this->Form->control('task_type');
            echo $this->Form->control('shared_type');
            echo $this->Form->control('type_icon');
            echo $this->Form->control('type_code');
            echo $this->Form->control('task_requirement');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
