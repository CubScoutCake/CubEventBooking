<div class="invoiceItems index large-10 medium-9 columns content">
    <h3><?= __('Invoice Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('invoice_id') ?></th>
                <th><?= $this->Paginator->sort('itemtype_id') ?></th>
                <th><?= $this->Paginator->sort('Description') ?></th>
                <th><?= $this->Paginator->sort('Quantity') ?></th>
                <th><?= $this->Paginator->sort('Value') ?></th>
                <th><?= $this->Paginator->sort('Quantity Price') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoiceItems as $invoiceItem): ?>
            <tr>
                <td><?= $invoiceItem->has('invoice') ? $this->Html->link($invoiceItem->invoice->id, ['controller' => 'Invoices', 'action' => 'view', $invoiceItem->invoice->id]) : '' ?></td>
                <td><?= $invoiceItem->has('itemtype') ? $this->Html->link($invoiceItem->itemtype->id, ['controller' => 'Itemtypes', 'action' => 'view', $invoiceItem->itemtype->id]) : '' ?></td>
                <td><?= h($invoiceItem->Description) ?></td>
                <td><?= $this->Number->format($invoiceItem->Quantity) ?></td>
                <td><?= $this->Number->currency($invoiceItem->Value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoiceItem->quantity_price,'GBP') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoiceItem->id]) ?>
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
