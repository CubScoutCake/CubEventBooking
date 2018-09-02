<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationStatus $applicationStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicationStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicationStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Application Statuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicationStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($applicationStatus) ?>
    <fieldset>
        <legend><?= __('Edit Application Status') ?></legend>
        <?php
            echo $this->Form->control('application_status');
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
