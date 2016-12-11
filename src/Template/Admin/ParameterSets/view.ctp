<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parameter Set'), ['action' => 'edit', $parameterSet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parameter Set'), ['action' => 'delete', $parameterSet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameterSet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parameter Sets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter Set'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parameterSets view large-9 medium-8 columns content">
    <h3><?= h($parameterSet->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($parameterSet->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($parameterSet->id) ?></td>
        </tr>
    </table>
</div>
