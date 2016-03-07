<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/champion_view');
    echo $this->element('Sidebar/champion');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="invoiceItems view large-9 medium-8 columns content">
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
            <td><?= $this->Number->format($invoiceItem->Value) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($invoiceItem->Quantity) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity Value') ?></th>
            <td><?= $this->Number->format($invoiceItem->quantity_price) ?></td>
        </tr>
    </table>
</div>
