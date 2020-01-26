<?php
/**
 * @var \App\Model\Entity\Invoice $invoice
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthRole $auth_role
 */
?>
<div class="row">
    <div class="col-lg-11 col-md-11">
        <h1 class="page-header"><i class="fal fa-file-invoice-dollar fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
    <div class="col-lg-1 col-md-1">
        <br/>
        <div class="pull-right pull-down">
            <div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <?php if ($auth_role->user_access) : ?>
                        <li><a href="<?php echo $this->Url->build([
                            'controller' => 'Invoices',
                            'action' => 'regenerate',
                            'prefix' => false,
                            $invoice->id],['_full']); ?>">Update Invoice</a>
                        </li>
                    <?php endif; ?>
                    <li><a href="<?php echo $this->Url->build([
		                    'controller' => 'Invoices',
		                    'action' => 'view',
		                    'prefix' => false,
		                    $invoice->id,
		                    '_ext' => 'pdf',
                        ]); ?>"><span><i class="fal fa-file-pdf fa-fw"></i> Download</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <br/>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></span>
                <br/>
                <?php if ($invoice->has('application')) : ?>
                <span><?= __('Application') ?>: <?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></span>
                <?php endif; ?>
                <?php if ($invoice->has('reservation')) : ?>
                    <span><?= __('Reservation') ?>: <?= $invoice->has('reservation') ? $this->Html->link($invoice->reservation->reservation_number, ['controller' => 'Reservations', 'action' => 'view', $invoice->reservation->id]) : '' ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('Date Created') ?>: <?= h($this->Time->format($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London')) ?></span>
                <br/>
                <span><?= __('Date Last Modified') ?>: <?= h($this->Time->format($invoice->modified,'dd-MMM-YY HH:mm', 'Europe/London')) ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th><?= __('Initial Value') ?></th>
                    <th><?= __('Payments Received') ?></th>
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
<?php if (!empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <i class="fal fa-file-invoice-dollar fa-fw"></i> Invoice Line Items
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
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
                            <td><?= h($this->Number->currency($invoiceItems->value,'GBP')) ?></td>
                            <td><?= h($this->Number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <?= $this->element('terms', ['invoice' => $invoice]) ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <?= $this->element('terms', ['invoice' => $invoice]) ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (!empty($invoice->schedule_items)): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <i class="fal fa-clock fa-fw"></i> Deposit Schedule
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Quantity') ?></th>
                                <th><?= __('Value') ?></th>
                                <th><?= __('Sum Price') ?></th>
                            </tr>
                            <?php foreach ($invoice->schedule_items as $invoiceItems): ?>
                                <tr>
                                    <td><?= h($invoiceItems->description) ?></td>
                                    <td><?= h($invoiceItems->quantity) ?></td>
                                    <td><?= h($this->Number->currency($invoiceItems->value,'GBP')) ?></td>
                                    <td><?= h($this->Number->currency($invoiceItems->quantity_price,'GBP')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php $invoice->has('application') ? $depositDate = $invoice->application->event->deposit_date : $depositDate = $invoice->reservation->event->deposit_date ?>
                    <p>The full value of the Deposit above is due before: <strong><?= h($this->Time->format($depositDate,'dd-MMM-YY', 'Europe/London')) ?></strong></p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->payments)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-receipt fa-fw"></i> Payments Received
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                    <td><?= $this->Time->format($payments->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                    <td><?= $this->Time->format($payments->paid,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                    <td><?= h($payments->name_on_cheque) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (empty($invoice->payments)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-receipt fa-fw"></i> Payments received will be listed here.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->notes)) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-edit fa-fw"></i> Invoice Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Note') ?></th>
                                <th><?= __('Last Modified') ?></th>
                            </tr>
                            <?php foreach ($invoice->notes as $notes): ?>
                                <tr>
                                    <td><?= h($notes->id) ?></td>
                                    <td><?= $this->Text->autoParagraph($notes->note_text) ?></td>
                                    <td><?= $this->Time->format($notes->modified,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

