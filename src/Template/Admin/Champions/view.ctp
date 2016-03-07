<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Champion'), ['action' => 'edit', $champion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Champion'), ['action' => 'delete', $champion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $champion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Champions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Champion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Districts'), ['controller' => 'Districts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'Districts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="champions view large-9 medium-8 columns content">
    <h3><?= h($champion->firstname) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('District') ?></th>
            <td><?= $champion->has('district') ? $this->Html->link($champion->district->district, ['controller' => 'Districts', 'action' => 'view', $champion->district->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Firstname') ?></th>
            <td><?= h($champion->firstname) ?></td>
        </tr>
        <tr>
            <th><?= __('Lastname') ?></th>
            <td><?= h($champion->lastname) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($champion->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($champion->id) ?></td>
        </tr>
        <tr>
            <th><?= __('User Id') ?></th>
            <td><?= $this->Number->format($champion->user_id) ?></td>
        </tr>
    </table>
</div>
