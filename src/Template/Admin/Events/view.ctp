<?php
/**
 * @var string $pluralTerm
 * @var string $term
 * @var string $singleTerm
 *
 * @var int $maxSection
 *
 * @var \App\View\AppView $this
 *
 * @var \App\Model\Entity\Event $event
 *
 * @var array $lineArray
 *
 * @var bool $complete
 * @var bool $pending
 * @var bool $started
 * @var bool $over
 * @var bool $full
 */
?>
<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css'); ?>
<div class="row">
    <div class="col-lg-11 col-md-10">
        <h1 class="page-header"><i class="fal fa-calendar-star fa-fw"></i> <?= h($event->name) ?></h1>
    </div>
    <div class="col-lg-1 col-md-2">
        <div class="pull-right pull-down">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right pull-down" role="menu">
                    <li><?= $this->Html->link(__('Accounts View'), ['action' => 'accounts', $event->id]) ?></li>
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
    </div> 
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-key fa-fw"></i> Key Event Information
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Full Name') ?></th>
                            <td><?= h($event->full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Location') ?></th>
                            <td><?= h($event->location) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Event Start') ?></th>
                            <th><?= __('Event End') ?></th>
                        </tr>
                        <tr>
                            <td><?= $this->Time->format($event->start_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                            <td><?= $this->Time->format($event->end_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Deposit Deadline') ?></th>
                            <th><?= __('Closing Date') ?></th>
                        </tr>
                        <tr>
                            <td><?= $this->Time->format($event->opening_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                            <td><?= $this->Time->format($event->closing_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-cog fa-fw"></i> Event Settings
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td><?= $pluralTerm ?> are limited to <?= $maxSection ?> <?= $event->section_type->role->role ?>s per <?= $singleTerm ?></td>
                        </tr>
                        <tr>
                            <td><?= $event->max ? __('Numbers Limited') : __('Numbers Not Limited'); ?></td>
                        </tr>
                        <tr>
                            <td><?= $event->allow_reductions ? __('Invoices can be Reduced') : __('Invoices can only be Increased'); ?></td>
                        </tr>
                        <tr>
                            <td><?= $event->invoices_locked ? __('Invoices are Locked') : __('Invoices can be Updated'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-clock fa-fw"></i> Event Status
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td><strong>Event Status:</strong> <?= h($event->event_status->event_status) ?></td>
                        </tr>
                        <tr>
                            <td>Complete: <?= $complete ? __('Y') : __('N'); ?></td>
                        </tr>
                        <tr>
                            <td>Pending: <?= $pending ? __('Y') : __('N'); ?></td>
                        </tr>
                        <tr>
                            <td>Started: <?= $started ? __('Y') : __('N'); ?></td>
                        </tr>
                        <tr>
                            <td>Over: <?= $over ? __('Y') : __('N'); ?></td>
                        </tr>
                        <tr>
                            <td>Full: <?= $full ? __('Y') : __('N'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php if ($event->max) : ?>
            <?php $spaces = $event->cc_res + $event->cc_apps; ?>
            <br />
            <div class="row">
                <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo (($spaces / $event->max_apps) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($spaces / $event->max_apps),1,['multiply' => true]); ?>">
                                    <span class="sr-only"><?= $this->Number->toPercentage(($spaces / $event->max_apps),1,['multiply' => true]); ?> Complete</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fal fa-thermometer-half fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="large"><?= $this->Number->format($spaces) ?> <?= h($term) ?> of <?= $this->Number->format($event->max_apps) ?> Taken</div>
                                    <div class="huge"><?= $this->Number->toPercentage(($spaces / $event->max_apps),1,['multiply' => true]); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo (($spaces / $event->max_section) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($spaces / $event->max_section),1,['multiply' => true]); ?>">
                                        <span class="sr-only"><?= $this->Number->toPercentage(($spaces / $event->max_section),1,['multiply' => true]); ?> Complete</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fal fa-thermometer-half fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="large"><?= $this->Number->format($spaces) ?> <?= h($term) ?> of <?= $this->Number->format($event->max_section) ?> Taken</div>
                                        <div class="huge"><?= $this->Number->toPercentage(($spaces / $event->max_section),1,['multiply' => true]); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($event->has('logistics')) : ?>
                    <?php foreach ($event->logistics as $logistic) : ?>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?= h($logistic->header) ?></h4>
                                </div>
                                <?php foreach ($logistic->parameter->params as $param) : ?>
                                <div class="panel-body">
                                    <?php if (key_exists('remaining', $logistic->variable_max_values[$param->id])) : ?>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo (($logistic->variable_max_values[$param->id]['current'] / $logistic->variable_max_values[$param->id]['limit']) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($logistic->variable_max_values[$param->id]['current'] / $logistic->variable_max_values[$param->id]['limit']),1,['multiply' => true]); ?>">
                                                <span class="sr-only"><?= $this->Number->toPercentage(($logistic->variable_max_values[$param->id]['current'] / $logistic->variable_max_values[$param->id]['limit']),1,['multiply' => true]); ?> Complete</span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <h3><i class="fal fa-inventory fa-fw"></i> <?= $param->constant ?></h3>
                                        </div>
                                        <?php if (key_exists('remaining', $logistic->variable_max_values[$param->id])) : ?>
                                            <div class="col-xs-4 text-right">
                                                <div class="large"><?= $this->Number->format($logistic->variable_max_values[$param->id]['current']) ?> of <?= $this->Number->format($logistic->variable_max_values[$param->id]['limit']) ?> Taken</div>
                                                <div class="huge"><?= $this->Number->toPercentage(($logistic->variable_max_values[$param->id]['current'] / $logistic->variable_max_values[$param->id]['limit']),1,['multiply' => true]); ?></div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if (!empty($lineArray)) : ?>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                District Breakdown
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="district-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <?php endif; ?>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-mobile fa-fw"></i> Event Organiser Contact
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Contact Person') ?></th>
                            <td><?= h($event->admin_user->full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Contact Email') ?></th>
                            <td><?= $this->Text->autoLink($event->admin_user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Address') ?></th>
                            <td><?= h($event->admin_user->address_1) ?><br/>
                                <?= h($event->admin_user->address_2) ?><br/>
                                <?= h($event->admin_user->city) ?> <br/>
                                <?= h($event->admin_user->county) ?> <br/>
                                <?= h($event->admin_user->postcode) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-receipt fa-fw"></i> Prices
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Price Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><?= $this->Html->link(__('Edit Prices'), ['controller' => 'Events', 'action' => 'prices', $event->id]) ?></li>
                            <li class="divider"></li>
                            <li><?= $this->Html->link(__('Add Price'), ['controller' => 'Prices', 'action' => 'add']) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<?php if (!empty($event->prices)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Attendee Type'); ?></th>
                                <th><?= __('Qualifying Role'); ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                <th><?= __('Max Number'); ?></th>
                                <th><?= __('Price'); ?></th>
                                <th><?= __('Invoice Text'); ?></th>

                            </tr>
							<?php foreach ($event->prices as $price): ?>
                                <tr>
                                    <td><?= $price->has('item_type') ? h($price->item_type->item_type) : '' ?></td>
                                    <td><?= $price->has('item_type') ? $price->item_type->has('role') ? $this->Html->link($price->item_type->role->role, ['controller' => 'Roles', 'action' => 'view', $price->item_type->role->id]) : 'Multiple' : '' ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fal fa-cog"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Prices', 'action' => 'Edit', $price->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Prices', 'action' => 'delete', $price->id], ['confirm' => __('Are you sure you want to delete # {0}?', $price->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $this->Number->format($price->max_number) ?></td>
                                    <td><?= $this->Number->currency($price->value,'GBP') ?></td>
                                    <td><?= h($price->description) ?></td>
                                </tr>
							<?php endforeach; ?>
                        </table>
                    </div>
				<?php endif; ?>
				<?php if (empty($event->prices)): ?>
                    <h2><i class="fal fa-calendar-exclamation fa-3x"></i> There are no prices set.</h2>
				<?php endif; ?>
            </div>
            <div class="panel-footer">
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
                            <td><?= $this->Time->format($event->deposit_date, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                            <td><?= $this->Number->currency($event->deposit_value,'GBP') ?></td>
                            <td><?= h($event->deposit_text) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
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
        </div>
    </div>
</div>

<!-- Morris Charts JavaScript -->
<?= $this->element('Scripts/morris') ?>

<script>
    new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'district-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: <?php echo $lineArray; ?>,
        // The name of the data record attribute that contains x-values.
        xkey: 'label',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['District'],
        hideHover: 'auto',
        resize: true
    });
</script>



