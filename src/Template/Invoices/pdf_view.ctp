<nav class="actions large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">

        <?= $this->start('Sidebar');
        echo $this->element('Sidebar/invoice_view_regenerate');
        echo $this->element('Sidebar/user');
        $this->end(); ?>
        
        <?= $this->fetch('Sidebar') ?>
        
    </ul>
</nav>
<div class="invoices view large-9 medium-8 columns content">
    <h3>Payment Invoice</h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Invoice ID Number') ?></th>
            <td><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Application') ?></th>
            <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
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
        <tr>
            <th><?= __('Date Last Modified') ?></th>
            <td><?= h($this->Time->i18nFormat($invoice->modified,'dd-MMM-YYYY HH:mm')) ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Invoice Line Items') ?></h4>
        <?php if (!empty($invoice->invoice_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Description') ?></th>
                <th><?= __('Quantity') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Sum Price') ?></th>
            </tr>
            <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
            <tr>
                <td><?= h($invoiceItems->Description) ?></td>
                <td><?= h($invoiceItems->Quantity) ?></td>
                <td><?= h($this->number->currency($invoiceItems->Value,'GBP')) ?></td>
                <td><?= h($this->number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
        <div class="warning">

            <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>

        </div>
    </div>
    <div class="related">
        <h4><?= __('Payments Recieved') ?></h4>
        <?php if (!empty($invoice->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Paid') ?></th>
                <th><?= __('Name on Cheque') ?></th>
            </tr>
            <?php foreach ($invoice->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= $this->Number->currency($payments->value,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($payments->created,'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nformat($payments->paid,'dd-MMM-yy HH:mm') ?></td>
                <td><?= h($payments->name_on_cheque) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
