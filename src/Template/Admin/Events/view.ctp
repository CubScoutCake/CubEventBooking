<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css'); ?>
<div class="row">
    <div class="col-lg-11 col-md-10">
        <h1 class="page-header"><i class="fa fa-calendar-o fa-fw"></i> <?= h($event->name) ?></h1>
    </div>
    <div class="col-lg-1 col-md-2">
        <div class="pull-right pull-down">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right pull-down" role="menu">
                    <li><?= $this->Html->link(__('Preview - User View'), ['action' => 'view', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Accounts View'), ['action' => 'accounts', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Export Data'), ['controller' => 'Events','action' => 'export', $event->id]) ?></li>
                    <li><?= $this->Html->link(__('Outstanding Invoices'), ['controller' => 'Invoices','action' => 'outstanding', $event->id]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?></li>
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
                <i class="fa fa-key fa-fw"></i> Key Event Information
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
                            <td><?= $this->Time->i18nFormat($event->start_date, 'dd-MMM-yy HH:mm') ?></td>
                            <td><?= $this->Time->i18nFormat($event->end_date, 'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Deposit Deadline') ?></th>
                            <th><?= __('Closing Date') ?></th>
                        </tr>
                        <tr>
                            <td><?= $event->deposit ? $this->Time->i18nFormat($event->deposit_date, 'dd-MMM-yy HH:mm') : __('No Deposit Date'); ?></td>
                            <td><?= $this->Time->i18nFormat($event->closing_date, 'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php if ($event->max) : ?>
            <div class="row">
                <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                    <?php if ($event->max_section == 0 || is_null($event->max_section)) : ?>
                        <div class="col-lg-12">
                    <?php endif; ?>
                    <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                    <div class="col-lg-6">
                <?php endif; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo (($event->cc_apps / $event->max_apps) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($event->cc_apps / $event->max_apps),1,['multiply' => true]); ?>">
                                    <span class="sr-only"><?= $this->Number->toPercentage(($event->cc_apps / $event->max_apps),1,['multiply' => true]); ?> Complete</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thermometer-half fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="large"><?= $this->Number->format($event->cc_apps) ?> <?= h($term) ?> of <?= $this->Number->format($event->max_apps) ?> Available</div>
                                    <div class="huge"><?= $this->Number->toPercentage(($event->cc_apps / $event->max_apps),1,['multiply' => true]); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($event->max_section == 0 || is_null($event->max_section)) : ?>
                    </div>
                <?php endif; ?>
                    <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($event->max_section > 0 && !is_null($event->max_section)) : ?>
                    <?php if ($event->max_apps == 0 || is_null($event->max_apps)) : ?>
                        <div class="col-lg-12">
                    <?php endif; ?>
                    <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                    <div class="col-lg-6">
                <?php endif; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo (($event->cc_apps / $event->max_section) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage(($event->cc_apps / $event->max_section),1,['multiply' => true]); ?>">
                                    <span class="sr-only"><?= $this->Number->toPercentage(($event->cc_apps / $event->max_section),1,['multiply' => true]); ?> Complete</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thermometer-half fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Event Availability</div>
                                    <div class="huge"><?= $this->Number->format($event->max_section - $event->cc_apps) ?> Attendee Slots Available</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($event->max_apps == 0 || is_null($event->max_apps)) : ?>
                    </div>
                <?php endif; ?>
                    <?php if ($event->max_apps > 0 && !is_null($event->max_apps)) : ?>
                        </div>
                    <?php endif; ?>
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
    <?php if (empty($lineArray)) : ?>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope-o fa-fw"></i> Event Organiser Contact
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Contact Person') ?></th>
                            <td><?= h($event->admin_full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Contact Email') ?></th>
                            <td><?= $this->Text->autoLink($event->admin_email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Address') ?></th>
                            <td><?= h($event->address) ?> </br>
                                <?= h($event->city) ?> </br>
                                <?= h($event->county) ?> </br>
                                <?= h($event->postcode) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-gbp fa-fw"></i> Prices
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Attendee Type'); ?></th>
                            <th><?= __('Booking Permited'); ?></th>
                            <th><?= __('Max Number'); ?></th>
                            <th><?= __('Price'); ?></th>
                            <th><?= __('Invoice Text'); ?></th>
                        </tr>
                        <tr>
                            <td><?= __('Cubs'); ?></td>
                            <td><?= $event->cubs ? __('Yes') : __('No'); ?></td>
                            <td><?php if (isset($event->max_cubs) && $event->max_cubs > 0) {
                                    $this->Number->format($event->max_cubs);
                                } else {
                                    echo 'Not Limited';
                                } ?></td>
                            <td><?= $this->Number->currency($event->cubs_value,'GBP') ?></td>
                            <td><?= h($event->cubs_text) ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Young Leaders'); ?></td>
                            <td><?= $event->yls ? __('Yes') : __('No'); ?></td>
                            <td><?php if (isset($event->max_yls) && $event->max_yls > 0) {
                                    $this->Number->format($event->max_yls);
                                } else {
                                    echo 'Not Limited';
                                } ?></td>
                            <td><?= $this->Number->currency($event->yls_value,'GBP') ?></td>
                            <td><?= h($event->yls_text) ?></td>
                        </tr>
                        <tr>
                            <td><?= __('Leaders'); ?></td>
                            <td><?= $event->leaders ? __('Yes') : __('No'); ?></td>
                            <td><?php if (isset($event->max_leaders) && $event->max_leaders > 0) {
                                    $this->Number->format($event->max_leaders);
                                } else {
                                    echo 'Not Limited';
                                } ?></td>
                            <td><?= $this->Number->currency($event->leaders_value,'GBP') ?></td>
                            <td><?= h($event->leaders_text) ?></td>
                        </tr>
                    </table>
                </div>
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
                            <td><?= $this->Time->i18nFormat($event->deposit_date, 'dd-MMM-yy HH:mm') ?></td>
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
<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js');?>
<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js');?>
<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js');?>

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



