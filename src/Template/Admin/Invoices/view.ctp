<div class="row">
    <div class="col-lg-10 col-md-9">
        <h1 class="page-header"><i class="fa fa-files-o fa-fw"></i> Payment Invoice INV #<?= $this->Number->format($invoice->id) ?></h1>
    </div>
    <div class="col-lg-1 col-md-1">
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-warning dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o fa-fw"></i>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><?= $this->Html->link(__('Outstanding Payment'), ['controller' => 'Notifications', 'action' => 'outstanding', 'prefix' => 'admin', $invoice->id]) ?></li>
                    <li><?= $this->Html->link(__('++ Send User Invoice PDF'), ['controller' => 'Notifications', 'action' => 'invdownload', 'prefix' => 'admin', $invoice->id]) ?></li>
                </ul>
            </div>
        </div>
        </br>
    </div>
    <div class="col-lg-1 col-md-2">
        </br>
        <div class="pull-right pull-down">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-warning dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'regenerate',
                        'prefix' => 'admin',
                        $invoice->id],['_full']); ?>">Update Invoice</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'edit',
                        'prefix' => 'admin',
                        $invoice->id],['_full']); ?>">Edit Invoice</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'pdf_view',
                        'prefix' => 'admin',
                        $invoice->id],['_full']); ?>">Download Invoice</a>
                    </li>
                    <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete','prefix' => 'admin', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Add Note'), ['controller' => 'Notes', 'action' => 'new_invoice', 'prefix' => 'admin', $invoice->id]) ?></li>
                </ul>
            </div>
        </div>
        </br>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $invoice->has('user') ? $this->Html->link($invoice->user->full_name, ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></span>
                </br>
                <span><?= __('Application') ?>: <?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></span>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-body">
                <span><?= __('Date Created') ?>: <?= h($this->Time->i18nFormat($invoice->created,'dd-MMM-YYYY HH:mm')) ?></span>
                </br>
                <span><?= __('Date Last Modified') ?>: <?= h($this->Time->i18nFormat($invoice->modified,'dd-MMM-YYYY HH:mm')) ?></span>
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
<?php if (!empty($invoice->invoice_items)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Invoice Line Items
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Value') ?></th>
                            <th><?= __('Sum Price') ?></th>
                            <th><?= __('Visible') ?></th>
                        </tr>
                        <?php foreach ($invoice->invoice_items as $invoiceItems): ?>
                        <tr>
                            <td><?= h($invoiceItems->Description) ?></td>
                            <td><?= h($invoiceItems->Quantity) ?></td>
                            <td><?= h($this->number->currency($invoiceItems->Value,'GBP')) ?></td>
                            <td><?= (strpos($invoiceItems->Description, 'CANCELLED') !== false)  ? $this->Html->link($this->number->currency($invoiceItems->quantity_price,'GBP'),['controller' => 'InvoiceItems', 'action' => 'edit', $invoiceItems->id, 'prefix' => 'admin' ]) : $this->number->currency($invoiceItems->quantity_price,'GBP'); ?></td>
                            <td><?= $invoiceItems->visible ? __('Yes') : __('No'); ?>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
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
                <p>Deposits for invoices should be made payable to <strong><?= h($invPayable) ?></strong> and sent to <strong><?= h($eventName) ?>, <?= h($invAddress) ?>, <?= h($invCity) ?>, <?= h($invPostcode) ?></strong> by <strong><?= $this->Time->i18nformat($invDeadline,'dd-MMM-yyyy') ?></strong>. Please write <strong><?= h($invPrefix) ?><?= $this->Number->format($invoice->id) ?></strong> on the back of the cheque.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->payments)): ?>
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments Recieved
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body"><div class="related">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Actions') ?></th>
                                <th><?= __('Value') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Paid') ?></th>
                                <th><?= __('Name on Cheque') ?></th>
                            </tr>
                            <?php foreach ($invoice->payments as $payments): ?>
                                <tr>
                                    <td><?= h($payments->id) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-gear"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Payments', 'prefix' => 'admin', 'action' => 'view', $payments->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'prefix' => 'admin', 'action' => 'edit', $payments->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'prefix' => 'admin', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?></li>
                                                <li class="divider"></li>
                                                <li><?= $this->Html->link(__('Notify'), ['controller' => 'Notifications', 'action' => 'notify_payment', $payments->id]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $this->Number->currency($payments->value,'GBP') ?></td>
                                    <td><?= $this->Time->i18nformat($payments->created,'dd-MMM-yy HH:mm') ?></td>
                                    <td><?= $this->Time->i18nformat($payments->paid,'dd-MMM-yy HH:mm') ?></td>
                                    <td><?= h($payments->name_on_cheque) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (empty($invoice->payments)): ?>
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <i class="fa fa-gbp fa-fw"></i> Payments received will be listed here.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>    

<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($invoice->notes)) : ?>
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <i class="fa fa-pencil-square-o fa-fw"></i> Invoice Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Actions') ?></th>
                                <th><?= __('Note') ?></th>
                                <th><?= __('Last Modified') ?></th>
                            </tr>
                            <?php foreach ($invoice->notes as $notes): ?>
                                <tr>
                                    <td><?= h($notes->id) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-gear"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'view', $notes->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'edit', $notes->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'delete', $notes->id], ['confirm' => __('Are you sure you want to delete note # {0}?', $notes->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $this->Text->autoParagraph($notes->note_text) ?></td>
                                    <td><?= $this->Time->i18nformat($notes->modified,'dd-MMM-yy HH:mm') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

