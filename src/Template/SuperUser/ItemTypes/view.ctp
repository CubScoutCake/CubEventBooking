<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ItemType $itemType
 */
?>
<div class="itemTypes view large-9 medium-8 columns content">
    <h3><?= h($itemType->item_type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Item Type') ?></th>
            <td><?= h($itemType->item_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $itemType->has('role') ? $this->Html->link($itemType->role->role, ['controller' => 'Roles', 'action' => 'view', $itemType->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minor') ?></th>
            <td><?= $itemType->minor ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cancelled') ?></th>
            <td><?= $itemType->cancelled ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Available') ?></th>
            <td><?= $itemType->available ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team Price') ?></th>
            <td><?= $itemType->team_price ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deposit') ?></th>
            <td><?= $itemType->deposit ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Invoice Items') ?></h4>
        <?php if (!empty($itemType->invoice_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Invoice Id') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Item Type Id') ?></th>
                <th scope="col"><?= __('Visible') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemType->invoice_items as $invoiceItems): ?>
            <tr>
                <td><?= h($invoiceItems->id) ?></td>
                <td><?= h($invoiceItems->invoice_id) ?></td>
                <td><?= h($invoiceItems->value) ?></td>
                <td><?= h($invoiceItems->description) ?></td>
                <td><?= h($invoiceItems->quantity) ?></td>
                <td><?= h($invoiceItems->item_type_id) ?></td>
                <td><?= h($invoiceItems->visible) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InvoiceItems', 'action' => 'view', $invoiceItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InvoiceItems', 'action' => 'edit', $invoiceItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InvoiceItems', 'action' => 'delete', $invoiceItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Prices') ?></h4>
        <?php if (!empty($itemType->prices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Item Type Id') ?></th>
                <th scope="col"><?= __('Event Id') ?></th>
                <th scope="col"><?= __('Max Number') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemType->prices as $prices): ?>
            <tr>
                <td><?= h($prices->id) ?></td>
                <td><?= h($prices->item_type_id) ?></td>
                <td><?= h($prices->event_id) ?></td>
                <td><?= h($prices->max_number) ?></td>
                <td><?= h($prices->value) ?></td>
                <td><?= h($prices->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Prices', 'action' => 'view', $prices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Prices', 'action' => 'edit', $prices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Prices', 'action' => 'delete', $prices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
