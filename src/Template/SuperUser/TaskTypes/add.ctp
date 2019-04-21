<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TaskType $taskType
 */
?>
<div class="taskTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($taskType) ?>
    <fieldset>
        <legend><?= __('Add Task Type') ?></legend>
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
