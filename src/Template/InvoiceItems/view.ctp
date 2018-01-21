<div class="invoiceItems view large-10 medium-9 columns content">
    <h3><?= h($invoiceItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Invoice') ?></th>
            <td><?= $invoiceItem->has('invoice') ? $this->Html->link($invoiceItem->invoice->id, ['controller' => 'Invoices', 'action' => 'view', $invoiceItem->invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($invoiceItem->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Item Type') ?></th>
            <td><?= $invoiceItem->has('item_type') ? $this->Html->link($invoiceItem->item_type->item_type, ['controller' => 'ItemTypes', 'action' => 'view', $invoiceItem->item_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoiceItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= $this->Number->currency($invoiceItem->value,GBP) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($invoiceItem->quantity) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity Price') ?></th>
            <td><?= $this->Number->currency($invoiceItem->quantity_price,GBP) ?></td>
        </tr>
    </table>
</div>
