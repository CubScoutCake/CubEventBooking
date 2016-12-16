<div class="row">
    <div class="col-lg-12 col-md-12">
        <h1 class="page-header"><i class="fa fa-files-o fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-warning">
            <div class="panel-body">
                <span><strong><?= __('User') ?>:</strong> <?= $invoice->has('user') ? $invoice->user->full_name : '' ?></span>
                </br>
                <span><strong><?= __('Application') ?>:</strong> <?= $invoice->has('application') ? $invoice->application->display_code : '' ?></span>
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
    <div class="col-lg-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Balance
            </div>
            <div class="panel-body">
                <table class="table table-condensed">  
                    <tr>
                        <th><?= __('Initial Value') ?></th>
                        <th><?= __('Payments Recieved') ?></th>
                        <th><?= __('Balance') ?></th>          
                    </tr>
                    <tr>
                        <td><span><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></span></td>
                        <td><span></span><?= $this->Number->currency($invoice->value,'GBP') ?></span></td>
                        <td><span><?= $this->Number->currency($invoice->balance,'GBP') ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->payments)): ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments Recieved
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Value') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Paid') ?></th>
                            <th><?= __('Name on Cheque') ?></th>
                        </tr>
                        <?php foreach ($invoice->payments as $payments): ?>
                            <tr>
                                <td><span><?= h($payments->id) ?></span></td>
                                <td><span><?= $this->Number->currency($payments->value,'GBP') ?></span></td>
                                <td><span><?= $this->Time->i18nformat($payments->created,'dd-MMM-yy') ?></span></td>
                                <td><span><?= $this->Time->i18nformat($payments->paid,'dd-MMM-yy') ?></span></td>
                                <td><span><?= $this->Text->wrap($payments->name_on_cheque,20); ?></span></td>
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
<?php if (!empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Invoice Line Items
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <tr>
                        <th><?= __('Description') ?></th>
                        <th><?= __('Quantity') ?></th>
                        <th><?= __('Value') ?></th>
                        <th><?= __('Sum Price') ?></th>
                    </tr>
                    <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
                    <tr>
                        <td><span><?= h($invoiceItems->Description) ?></span></td>
                        <td><span><?= h($invoiceItems->Quantity) ?></span></td>
                        <td><span><?= h($this->number->currency($invoiceItems->Value,'GBP')) ?></span></td>
                        <td><span><?= h($this->number->currency($invoiceItems->quantity_price,'GBP')) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
