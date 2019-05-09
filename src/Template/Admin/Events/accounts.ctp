<?php
/**
 * @var \App\Model\Entity\Event $event
 * @var int $cntApplications
 * @var int $cntInvoices
 *
 * @var float $sumValues
 * @var float $sumPayments
 * @var float $sumBalances
 *
 * @var int $appCubs
 * @var int $invCubs
 * @var int $canCubs
 *
 * @var int $appYls
 * @var int $invYls
 * @var int $canYls
 *
 * @var int $appLeaders
 * @var int $invLeaders
 * @var int $canLeaders
 *
 * @var float $invValueCubs
 * @var float $canValueCubs
 * @var float $invValueYls
 * @var float $canValueYls
 * @var float $invValueLeaders
 * @var float $canValueLeaders
 *
 * @var int $unpaid
 * @var int $outstanding
 */
?>
<div class="row">
    <div class="col-lg-9 col-md-8">
        <h1 class="page-header"><?= h($event->name) ?></h1>
    </div>
    <div class="col-lg-2 col-md-2">
        <br/>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right pull-down" role="menu">
                    <li><?= $this->Html->link(__('View Event'), ['action' => 'view', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Export Data'), ['controller' => 'Events','action' => 'export', $event->id]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Unpaid Invoices'), ['controller' => 'Invoices','action' => 'index', $event->id, '?' => ['unpaid' => true]]) ?></li>
                    <li><?= $this->Html->link(__('Outstanding Invoices'), ['controller' => 'Invoices','action' => 'index', $event->id, '?' => ['outstanding' => true],]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Edit Prices'), ['action' => 'prices', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Edit Logistics'), ['action' => 'logistics', $event->id]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Parse Invoices'), ['controller' => 'Invoices','action' => 'event_pdf', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Parse Applications'), ['controller' => 'Applications','action' => 'event_pdf', $event->id]) ?></li>
                </ul>
            </div>
        </div>
        <br/>
    </div> 
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-chart-bar fa-fw"></i> Summary Numbers
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><?= __('Property') ?></th>
                                <th><?= __('Applications / Reservations') ?></th>
                                <th><?= __('Invoices') ?></th>
                                <th><?= __('Cancelled') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?= __('Count') ?></th>
                                <td><?= is_null($cntApplications) && $event->cc_res > 0 ? $this->Number->format($cntApplications) : $event->cc_res ?></td>
                                <td><?= $this->Number->format($cntInvoices) ?></td>
                                <td></td>
                            </tr>
                            <?php if ($cntInvoices > 1 || $cntApplications > 1) : ?>
                                <tr>
                                    <th><?= __('Total Income') ?></th>
                                    <td></td>
                                    <td><?= $this->Number->currency($sumValues,'GBP') ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Payments') ?></th>
                                    <td></td>
                                    <td><?= $this->Number->currency($sumPayments,'GBP') ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Outstanding Balances') ?></th>
                                    <td></td>
                                    <td><?= $this->Number->currency($sumBalances,'GBP') ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Number of Cubs') ?></th>
                                    <td><?= $this->Number->format($appCubs) ?></td>
                                    <td><?= $this->Number->format($invCubs) ?></td>
                                    <td><?= $this->Number->format($canCubs) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Number of Young Leaders') ?></th>
                                    <td><?= $this->Number->format($appYls) ?></td>
                                    <td><?= $this->Number->format($invYls) ?></td>
                                    <td><?= $this->Number->format($canYls) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Number of Leaders') ?></th>
                                    <td><?= $this->Number->format($appLeaders) ?></td>
                                    <td><?= $this->Number->format($invLeaders) ?></td>
                                    <td><?= $this->Number->format($canLeaders) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Value of Cubs') ?></th>
                                    <td></td>
                                    <td><?= $this->Number->currency($invValueCubs,'GBP') ?></td>
                                    <td><?= $this->Number->currency($canValueCubs,'GBP') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Value of Young Leaders') ?></th>
                                    <td></td>
                                    <td><?= $this->Number->currency($invValueYls,'GBP') ?></td>
                                    <td><?= $this->Number->currency($canValueYls,'GBP') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Value of Leaders') ?></th>
                                    <td></td>
                                    <td><?= $this->Number->currency($invValueLeaders,'GBP') ?></td>
                                    <td><?= $this->Number->currency($canValueLeaders,'GBP') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Unpaid') ?></th>
                                    <td></td>
                                    <td><?= $this->Html->link($this->Number->format($unpaid),['controller' => 'Invoices', 'action' => 'index', $event->id, '?' => ['unpaid' => true]]) ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><?= __('Total Outstanding') ?></th>
                                    <td></td>
                                    <td><?= $this->Html->link($this->Number->format($outstanding),['controller' => 'Invoices', 'action' => 'index', $event->id, '?' => ['outstanding' => true]]) ?></td>
                                    <td></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Above is the same as the View Action Template - Bar Settings Information -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-level-down fa-fw"></i> Related Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <li class="active"><a href="#pric-pills" data-toggle="tab"><i class="fal fa-tags fa-fw"></i> Prices</a></li>
                    <?php if (!empty($event->applications)): ?>
                        <li><a href="#appl-pills" data-toggle="tab"><i class="fal fa-clipboard-list fa-fw"></i> Applications</a></li>
                    <?php endif; ?>
                    <?php if (!empty($invoices)): ?>
                        <li><a href="#invo-pills" data-toggle="tab"><i class="fal fa-file-invoice-dollar fa-fw"></i> Invoices</a></li>
                    <?php endif; ?>
                    <?php if (!empty($outInvoices)): ?>
                        <li><a href="#outi-pills" data-toggle="tab"><i class="fal fa-file-invoice-dollar fa-fw"></i> Outstanding Invoices</a></li>
                    <?php endif; ?>
                    <?php if (!empty($unpaidInvoices)): ?>
                        <li><a href="#unpa-pills" data-toggle="tab"><i class="fal fa-file-invoice-dollar fa-fw"></i> Unpaid Invoices</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="pric-pills">
                        <br/>
                        <?php if (!empty($event->prices)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th><?= __('Price Type'); ?></th>
                                        <th><?= __('Max Number'); ?></th>
                                        <th><?= __('Price'); ?></th>
                                        <th><?= __('Invoice Text'); ?></th>
                                    </tr>
                                    <?php foreach ($event->prices as $price): ?>
                                        <tr>
                                            <td><?= $price->has('item_type') ? h($price->item_type->item_type) : '' ?></td>
                                            <td><?= $this->Number->format($price->max_number) ?></td>
                                            <td><?= $this->Number->currency($price->value,'GBP') ?></td>
                                            <td><?= h($price->description) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($event->prices)): ?>
                            <h2><i class="fal fa-exclamation"></i> There are no prices set.</h2>
                        <?php endif; ?>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th><?= __('Deposit Required') ?></th>
                                    <th><?= __('Deposit Inc Leaders') ?></th>
                                    <th><?= __('Deposit Date') ?></th>
                                    <th><?= __('Deposit Value') ?></th>
                                    <th><?= __('Deposit Invoice Text') ?></th>
                                </tr>
                                <tr>
                                    <td><?= $event->deposit ? __('Yes') : __('No'); ?></td>
                                    <td><?= $event->deposit_inc_leaders ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Time->i18nFormat($event->deposit_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                    <td><?= $this->Number->currency($event->deposit_value,'GBP') ?></td>
                                    <td><?= h($event->deposit_text) ?></td>
                                </tr>
                            </table>
                            <hr>
                            <table class="table">
                                <tr>
                                    <th><?= __('Discount Available') ?></th>
                                    <th><?= __('Nature of Discount') ?></th>
                                    <th><?= __('Discount Ratio') ?></th>
                                    <th><?= __('Discount Value') ?></th>
                                    <th><?= __('Deposit Invoice Text') ?></th>
                                </tr>
                                <tr>
                                    <td><?= $event->has('discount') ? __('Yes') : __('No'); ?></td>
                                    <td><?= $event->has('discount') ? $this->Html->link($event->discount->discount, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : 'None' ?></td>
                                    <td><?= $event->has('discount') ? __('1 : ') . $this->Number->format($event->discount->discount_number) : '' ?></td>
                                    <td><?= $event->has('discount') ? __('(') . $this->Number->currency($event->discount->discount_value,'GBP') . __(')') : '' ?></td>
                                    <td><?= $event->has('discount') ? $this->Html->link($event->discount->text, ['controller' => 'Discounts', 'action' => 'view', $event->discount->id]) : '' ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php if (!empty($event->applications)): ?>
                    <div class="tab-pane fade in" id="appl-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= __('User') ?></th>
                                        <th><?= __('District') ?></th>
                                        <th><?= __('Scout Group') ?></th>
                                        <th><?= __('Section') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th><?= __('Modified') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($event->applications as $applications): ?>
                                        <tr>
                                            <td><?= h($applications->display_code) ?></td>
                                            <td class="actions">
                                                <div class="dropdown btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu " role="menu">
                                                        <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
                                                        <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td><?= $applications->has('user') ? $this->Html->link($this->Text->truncate($applications->user->full_name,24), ['controller' => 'Users', 'action' => 'view','prefix' => 'admin', $applications->user->id]) : '' ?></td>
                                            <td><?= $applications->section->scoutgroup->has('district') ? $this->Html->link($applications->section->scoutgroup->district->short_name, ['controller' => 'Districts', 'action' => 'view','prefix' => 'admin', $applications->section->scoutgroup->district->id]) : '' ?></td>
                                            <td><?= $applications->section->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->section->scoutgroup->scoutgroup,24), ['controller' => 'Scoutgroups', 'action' => 'view','prefix' => 'admin', $applications->section->scoutgroup->id]) : '' ?></td>
                                            <td><?= $applications->has('section') ? $this->Html->link($applications->section->section, ['controller' => 'Sections', 'action' => 'view','prefix' => 'admin', $applications->section->id]) : '' ?></td>
                                            <td><?= h($applications->created) ?></td>
                                            <td><?= h($applications->modified) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($invoices)): ?>
                        <div class="tab-pane fade in" id="invo-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Sum Value') ?></th>
                                            <th><?= __('Received') ?></th>
                                            <th><?= __('Balance') ?></th>
                                            <th><?= __('Date Created') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($invoices as $invoice): ?>
                                            <tr>
                                                <td><?= h($invoice->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?></li>
                                                            <li class="divider"></li>
                                                            <li><?= $this->Html->link(__('Add Payment'), ['controller' => 'Payments', 'action' => 'add', $invoice->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
                                                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                                                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($outInvoices)): ?>
                        <div class="tab-pane fade in" id="outi-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Sum Value') ?></th>
                                            <th><?= __('Received') ?></th>
                                            <th><?= __('Balance') ?></th>
                                            <th><?= __('Date Created') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($outInvoices as $invoice): ?>
                                            <tr>
                                                <td><?= h($invoice->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?></li>
                                                            <li class="divider"></li>
                                                            <li><?= $this->Html->link(__('Add Payment'), ['controller' => 'Payments', 'action' => 'add', $invoice->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
                                                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                                                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($unpaidInvoices)): ?>
                        <div class="tab-pane fade in" id="unpa-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Sum Value') ?></th>
                                            <th><?= __('Received') ?></th>
                                            <th><?= __('Balance') ?></th>
                                            <th><?= __('Date Created') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($unpaidInvoices as $invoice): ?>
                                            <tr>
                                                <td><?= h($invoice->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoice->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoice->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoice->id)]) ?></li>
                                                            <li class="divider"></li>
                                                            <li><?= $this->Html->link(__('Add Payment'), ['controller' => 'Payments', 'action' => 'add', $invoice->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
                                                <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                                                <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>