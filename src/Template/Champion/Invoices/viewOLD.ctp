<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_view');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="invoices view large-9 medium-8 columns content">
    <h3>Payment Invoice</h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->username, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Initial Value') ?></th>
            <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Payments Recieved') ?></th>
            <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Balance') ?></th>
            <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
        </tr>
        <tr>
            <th><?= __('Date Created') ?></th>
            <td><?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Invoice Line Items') ?></h4>
        <?php if (!empty($invoice->invoice_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Quantity') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
            <tr>
                <td><?= h($invoiceItems->id) ?></td>
                <td><?= h($this->number->currency($invoiceItems->Value,'GBP')) ?></td>
                <td><?= h($invoiceItems->Description) ?></td>
                <td><?= h($invoiceItems->Quantity) ?></td>
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
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($invoice->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Paid') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($invoice->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= h($this->number->currency($payments->value,'GBP')) ?></td>
                <td><?= h($payments->created) ?></td>
                <td><?= h($payments->paid) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
