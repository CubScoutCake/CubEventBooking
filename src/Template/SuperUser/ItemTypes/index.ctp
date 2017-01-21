<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invoice Items'), ['controller' => 'InvoiceItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invoice Item'), ['controller' => 'InvoiceItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemTypes index large-9 medium-8 columns content">
    <h3><?= __('Item Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('minor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cancelled') ?></th>
                <th scope="col"><?= $this->Paginator->sort('available') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemTypes as $itemType): ?>
            <tr>
                <td><?= $this->Number->format($itemType->id) ?></td>
                <td><?= h($itemType->item_type) ?></td>
                <td><?= $this->Number->format($itemType->role_id) ?></td>
                <td><?= h($itemType->minor) ?></td>
                <td><?= h($itemType->cancelled) ?></td>
                <td><?= h($itemType->available) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemType->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
