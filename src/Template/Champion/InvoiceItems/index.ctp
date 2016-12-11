<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="invoiceItems index large-10 medium-9 columns content">
    <h3><?= __('Invoice Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('invoice_id') ?></th>
                <th><?= $this->Paginator->sort('Value') ?></th>
                <th><?= $this->Paginator->sort('Description') ?></th>
                <th><?= $this->Paginator->sort('Quantity') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoiceItems as $invoiceItem): ?>
            <tr>
                <td><?= $this->Number->format($invoiceItem->id) ?></td>
                <td><?= $invoiceItem->has('invoice') ? $this->Html->link($invoiceItem->invoice->id, ['controller' => 'Invoices', 'action' => 'view', $invoiceItem->invoice->id]) : '' ?></td>
                <td><?= $this->Number->format($invoiceItem->Value) ?></td>
                <td><?= h($invoiceItem->Description) ?></td>
                <td><?= $this->Number->format($invoiceItem->Quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoiceItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoiceItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoiceItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
