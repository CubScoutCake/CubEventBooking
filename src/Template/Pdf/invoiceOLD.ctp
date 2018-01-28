<div class="row">
    <div class="col-xs-12">
        <h1 class="page-header"><i class="fa fa-files-o fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-warning">
            <div class="panel-body">
                <span><strong><?= __('User') ?>:</strong> <?= $invoice->has('user') ? $invoice->user->full_name : '' ?></span>
                </br>
                <span><strong><?= __('Application') ?>:</strong> <?= $invoice->has('application') ? $invoice->application->display_code : '' ?></span>
                </br>
                <span><strong><?= __('Event') ?>:</strong> <?= h($eventName) ?></span>
                </br>
                <span><strong><?= __('Date Created') ?>:</strong> <?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></span>
                </br>
                <span><strong><?= __('Date Last Modified') ?>:</strong> <?= h($this->Time->i18nFormat($invoice->modified,'dd-MMM-YYYY HH:mm')) ?></span>
            </div>
            <div class="panel-footer">
                <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Balance
            </div>
            <div class="panel-body">
                <table class="table">  
                    <tr class="active">
                        <th><?= __('Initial Value') ?></th>
                        <th><?= __('Payments Recieved') ?></th>
                        <th><?= __('Balance') ?></th>          
                    </tr>
                    <tr>
                        <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                        <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                        <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Invoice Line Items
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr class="active">
                        <th><?= __('Description') ?></th>
                        <th><?= __('Quantity') ?></th>
                        <th><?= __('Value') ?></th>
                        <th><?= __('Sum Price') ?></th>
                    </tr>
                    <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
                    <tr>
                        <td><?= h($invoiceItems->description) ?></td>
                        <td><?= h($invoiceItems->quantity) ?></td>
                        <td><?= h($this->number->currency($invoiceItems->value,'GBP')) ?></td>
                        <td><?= h($this->number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-xs-12">
        <?php if (!empty($invoice->payments)): ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments Recieved
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table">
                        <tr class="active">
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
                                <td><?= $this->Time->i18nformat($payments->created,'dd-MMM-yy') ?></td>
                                <td><?= $this->Time->i18nformat($payments->paid,'dd-MMM-yy') ?></td>
                                <td><?= $this->Text->wrap($payments->name_on_cheque,20); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        <?php if (empty($invoice->payments)): ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments received will be listed here.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>