<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Price'), ['action' => 'edit', $price->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Price'), ['action' => 'delete', $price->id], ['confirm' => __('Are you sure you want to delete # {0}?', $price->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Types'), ['controller' => 'ItemTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Type'), ['controller' => 'ItemTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="prices view large-9 medium-8 columns content">
    <h3><?= h($price->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item Type') ?></th>
            <td><?= $price->has('item_type') ? $this->Html->link($price->item_type->item_type, ['controller' => 'ItemTypes', 'action' => 'view', $price->item_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $price->has('event') ? $this->Html->link($price->event->name, ['controller' => 'Events', 'action' => 'view', $price->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($price->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($price->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Number') ?></th>
            <td><?= $this->Number->format($price->max_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= $this->Number->format($price->value) ?></td>
        </tr>
    </table>
</div>
