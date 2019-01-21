<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css'); ?>
<div class="row">
    <div class="col-lg-11 col-md-10">
        <h1 class="page-header"><i class="fal fa-calendar-star fa-fw"></i> <?= h($event->name) ?></h1>
    </div>
    <div class="col-lg-1 col-md-2">
        <div class="pull-right pull-down">
            <a href="<?php echo $this->Url->build([
		        'controller' => 'Events',
		        'action' => 'book',
		        'prefix' => false,
                $event->id
            ]); ?>">
                <button type="button" class="btn btn-default">
                    Book
                </button>
            </a>
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
                                    <i class="fal fa-thermometer-half fa-5x"></i>
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
                                    <i class="fal fa-thermometer-half fa-5x"></i>
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
                    <i class="fal fa-envelope-o fa-fw"></i> Event Organiser Contact
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
                <i class="fal fa-receipt fa-fw"></i> Prices
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
				<?php if (!empty($event->prices)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Attendee Type'); ?></th>
                                <th><?= __('Qualifying Role'); ?></th>
                                <th><?= __('Max Number'); ?></th>
                                <th><?= __('Price'); ?></th>
                                <th><?= __('Invoice Text'); ?></th>

                            </tr>
							<?php foreach ($event->prices as $price): ?>
                                <tr>
                                    <td><?= $price->has('item_type') ? h($price->item_type->item_type) : '' ?></td>
                                    <td><?= $price->has('item_type') ? $price->item_type->has('role') ? $this->Html->link($price->item_type->role->role, ['controller' => 'Roles', 'action' => 'view', $price->item_type->role->id]) : 'Multiple' : '' ?></td>
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
            <?php if ($event->deposit || $event->has('discount')) : ?>
            <div class="panel-footer">
                <?php if ($event->deposit) : ?>
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
                <?php endif; ?>
                <?php if ($event->has('discount')): ?>
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
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>



