<?php

/**
 * @var \App\Model\Entity\Invoice $invoice
 */

?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <h1 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><i class="fal fa-file-invoice-dollar fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-warning">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span><strong><?= __('Application') ?>:</strong> <?= $invoice->has('application') ? $invoice->application->display_code : '' ?></span>
                        <br/>
                        <span><strong><?= __('Event') ?>:</strong> <?= h($invoice->application->event->full_name) ?></span>
                        <br/>
                        <span><strong><?= __('Date Created') ?>:</strong> <?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></span>
                        <br/>
                        <span><strong><?= __('User') ?>:</strong> <?= $invoice->has('user') ? $invoice->user->full_name : '' ?></span>
                        <br/>
                        <span><strong><?= __('Section') ?>:</strong> <?= $invoice->application->has('section') ? $this->Text->truncate($invoice->application->section->section,30) : '' ?></span>
                        <br/>
                        <span><strong><?= __('Scout Group') ?>:</strong> <?= $invoice->application->has('section') ? $this->Text->truncate($invoice->application->section->scoutgroup->scoutgroup,30) : '' ?></span>
                        <br/>
                        <span><strong><?= __('District') ?>:</strong> <?= $invoice->application->has('section') ? $this->Text->truncate($invoice->application->section->scoutgroup->district->district,30) : '' ?></span>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <p>Deposits for invoices should be made payable to <strong><?= h($invoice->application->event->event_type->payable->text) ?></strong> and sent to <strong><?= h($invoice->application->event->name) ?>, <?= h($invoice->application->event->admin_user->address_1) ?>, <?= $invoice->application->event->admin_user->has('address_2') ? $invoice->application->event->admin_user->address_2 . ', ' : '' ?><?= h($invoice->application->event->admin_user->city) ?>, <?= h($invoice->application->event->admin_user->county) ?>. <?= h($invoice->application->event->admin_user->postcode) ?></strong> by <strong><?= $this->Time->i18nformat($invoice->application->event->closing_date,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invoice->application->event->event_type->invoice_text->text) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fal fa-file-invoice-dollar fa-fw"></i> Balance
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <tr>
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
        <div class="col-lg-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fal fa-file-invoice-dollar fa-fw"></i> Invoice Line Items
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
    <div class="col-lg-12">
		<?php if (!empty($invoice->payments)): ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fal fa-receipt fa-fw"></i> Payments Recieved
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tr>
                            <th><?= __('ID') ?></th>
                            <th><?= __('Value') ?></th>
                            <th><?= __('Paid') ?></th>
                            <th><?= __('Name on Cheque') ?></th>
                        </tr>
						<?php foreach ($invoice->payments as $payments): ?>
                            <tr>
                                <td><?= h($payments->id) ?></td>
                                <td><?= $this->Number->currency($payments->value,'GBP') ?></td>
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
                    <i class="fal fa-receipt fa-fw"></i> Payments received will be listed here.
                </div>
            </div>
		<?php endif; ?>
    </div>
</div>