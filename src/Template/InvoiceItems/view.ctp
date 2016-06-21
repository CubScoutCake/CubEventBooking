<div class="invoiceItems view large-10 medium-9 columns content">
    <h3><?= h($invoiceItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Invoice') ?></th>
            <td><?= $invoiceItem->has('invoice') ? $this->Html->link($invoiceItem->invoice->id, ['controller' => 'Invoices', 'action' => 'view', $invoiceItem->invoice->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($invoiceItem->Description) ?></td>
        </tr>
        <tr>
            <th><?= __('Itemtype') ?></th>
            <td><?= $invoiceItem->has('itemtype') ? $this->Html->link($invoiceItem->itemtype->id, ['controller' => 'Itemtypes', 'action' => 'view', $invoiceItem->itemtype->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoiceItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= $this->Number->currency($invoiceItem->Value,GBP) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->currency($invoiceItem->Quantity,GBP) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity Price') ?></th>
            <td><?= $this->Number->currency($invoiceItem->quantity_price,GBP) ?></td>
        </tr>
    </table>
</div>
