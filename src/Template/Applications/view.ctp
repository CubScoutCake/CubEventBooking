<?php
/**
 * @var \App\Model\Entity\Application $application
 */
?>
<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fal fa-clipboard-list fa-fw"></i> Application <?= h($application->display_code) ?></h1>
    </div>
    <div class="col-lg-2 col-md-2">
        <br/>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-success dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'edit',
                        'prefix' => false,
                        $application->id],['_full']); ?>">Edit Application</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'view',
                        'prefix' => false,
                        '_ext' => 'pdf',
                        $application->id]); ?>">Download Application</a>
                    </li>
                    <li><a href="<?php

                        $osm_event_id = $application->osm_event_id;
                        if (is_null($osm_event_id)) {
                            $osm_event_id = 0;
                        }

                        echo $this->Url->build([
			                'controller' => 'Applications',
			                'action' => 'sync_book',
			                'prefix' => false,
			                $application->event_id,
			                $osm_event_id,
			                $application->id
                        ],['_full']); ?>">Re-sync with OSM Event</a>
                    </li>
                    <li><a href="<?php 
                        if ($invDone < 0.5) :
                            echo $this->Url->build([
                            'controller' => 'Invoices',
                            'action' => 'generate',
                            'prefix' => false,
                            $application->id],['_full']); ?>">Update Application

                        <?php else : 
                            echo $this->Url->build([
                            'controller' => 'Invoices',
                            'action' => 'regenerate',
                            'prefix' => false,
                            $application->invoice->id],['_full']); ?>">Update Invoice

                        <?php endif ?></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#cancellation">Request Cancellation</a></li>
                </ul>
            </div>
        </div>
        <br/>
    </div>
</div>

<div class="modal fade" id="cancellation" tabindex="-1" role="dialog" aria-labelledby="listModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fal fa-ban fa-5x"></i>
                    </div>
                    <div class="col-xs-7 text-right">
                        <div class="huge">Cancellation</div>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <br/>
                    <div class="col-lg-offset-1 col-lg-10">
	                    <?= $this->Form->create($cancellationForm); ?>
                        <legend><?= __('Request Application Cancellation') ?></legend>
                        <p>Please enter a reason that you would like to cancel this application.</p>
                        <p>Where requests are received too close to the event, cancellation may not be possible.</p>
	                    <?php
	                    echo $this->Form->input('reason', ['label' => 'Reason for Cancellation Request.']);
	                    echo $this->Form->input('other_team_added', [ 'label' => 'Have you got another team entered?']);
	                    ?>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-3">
                        <p>Step 1 of 1</p>
                    </div>
                    <div class="col-xs-9 pull-right">
				        <?php echo $this->Form->submit(__('Submit'), ['class' => 'btn btn-primary']); ?>
				        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></span>
                <br/>
                <span><?= __('District') ?>: <?= $application->section->scoutgroup->has('district') ? $this->Html->link($application->section->scoutgroup->district->district, ['controller' => 'Scoutgroups', 'action' => 'view', $application->section->scoutgroup->district->id]) : '' ?></span>
                <br/>
                <span><?= __('Scout Group') ?>: <?= $application->section->has('scoutgroup') ? $this->Html->link($application->section->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $application->section->scoutgroup->id]) : '' ?></span>
                <br/>
                <span><?= __('Section') ?>: <?= $application->has('section') ? $this->Html->link($application->section->section, ['controller' => 'Sections', 'action' => 'view', $application->section->id]) : '' ?></span>
                <br/>
                <span><?= __('Leader') ?>: <?= h($application->leader) ?></span>

            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('Event') ?>: <?= $application->has('event') ? h($application->event->full_name) : '' ?></span>
                <br/>
                <span><?= __('App Number') ?>: <?= $this->Number->format($application->id) ?></span>
                <br/>
                <span><?= __('Date Created') ?>: <?= $this->Time->i18nFormat($application->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></span>
                <br/>
                <span><?= __('Last Modified') ?>: <?= $this->Time->i18nFormat($application->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-clipboard-list fa-fw"></i> Application Completion Progress
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div>   
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-<?= h($status) ?>" role="progressbar" aria-valuenow="<?php echo ($done * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($done,1,['multiply' => true]); ?>">
                            <span class="sr-only"><?= $this->Number->toPercentage($done,1,['multiply' => true]); ?> Complete</span>
                        </div>
                    </div>
                </div>
                <h2><?= $this->Number->toPercentage($done,1,['multiply' => true]); ?></h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel-group">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <i class="fal fa-file-invoice-dollar"></i> Invoices
                </div>
                <div class="panel-body">
                    <div>
                        <p>
                            <strong>Invoice Progress</strong>
                            <br/>
                            <span class="pull-right text-muted"><?= $this->Number->format($invCount); ?> <?php if ($invCount == 1) : ?>Invoice<?php else : ?>Invoices<?php endif ?></span>
                            <br/>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo ($invDone * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($invDone,1,['multiply' => true]); ?>">
                                <span class="sr-only"><?= $this->Number->toPercentage($invDone,1,['multiply' => true]); ?> Complete</span>
                            </div>
                        </div>
                    </div>
                    <h2><?= $this->Number->toPercentage($invDone,1,['multiply' => true]); ?></h2>
                </div>
                <a href="<?php 
                    if ($invDone < 0.5) :
                        echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'generate',
                        'prefix' => false,
                        $application->id],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Generate a New Invoice</span>

                    <?php else : 
                        echo $this->Url->build([
                            'controller' => 'Invoices',
                            'action' => 'regenerate',
                            'prefix' => false,
                            $application->invoice->id],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Update Existing Invoice</span>
                    <?php endif ?>
                    
                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fal fa-poll-people"></i> Attendees
                </div>
                <div class="panel-body">
                    <div>
                        <p>
                            <strong>Cub Attendee Progress</strong>
                            <br/>
                            <span class="pull-right text-muted"><?= $this->Number->format($attCubs); ?> Cubs of <?= $this->Number->format($invCubs); ?> on Invoice</span>
                            <br/>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo ($cubsDone * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?>">
                                <span class="sr-only"><?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?> Complete</span>
                            </div>
                        </div>
                    </div>
                    <h2><?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?></h2>
                </div>
                <a href="<?php 
                    if ($cubsDone < 1) :
                        echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'Link',
                        'prefix' => false,
                        $application->id],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Link Attendees</span>

                    <?php else : 
                        echo $this->Url->build([
                        'controller' => 'Attendees',
                        'action' => 'cub',
                        'prefix' => false],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Add a Cub</span>
                    <?php endif ?>

                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fal fa-poll-people"></i> Attendees
                </div>
                <div class="panel-body">
                    <div>
                        <p>
                            <strong>Leader Attendee Progress</strong>
                            <br/>
                            <span class="pull-right text-muted"><?= $this->Number->format($attNotCubs); ?> Leaders of <?= $this->Number->format($invNotCubs); ?> on Invoice</span>
                            <br/>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo ($cubsNotDone * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?>">
                                <span class="sr-only"><?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?> Complete</span>
                            </div>
                        </div>
                    </div>
                    <h2><?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?></h2>
                </div>
                <a href="<?php 
                    if ($cubsNotDone < 1) :
                        echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'Link',
                        'prefix' => false,
                        $application->id],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Link Attendees</span>

                    <?php else : 
                        echo $this->Url->build([
                        'controller' => 'Attendees',
                        'action' => 'adult',
                        'prefix' => false],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Add an Adult</span>
                    <?php endif ?>
                    
                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <i class="fal fa-receipt"></i> Payments
                </div>
                <div class="panel-body">
                    <div>
                        <p>
                            <strong>Balance Paid Progress</strong>
                            <br/>
                            <span class="pull-right text-muted"><?= $this->Number->currency($sumPayments,'GBP'); ?> of <?= $this->Number->currency($sumValues,'GBP'); ?></span>
                            <br/>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo ($payDone * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($payDone,1,['multiply' => true]); ?>">
                                <span class="sr-only"><?= $this->Number->toPercentage($payDone,1,['multiply' => true]); ?> Complete</span>
                            </div>
                        </div>
                    </div>
                    <h2><?= $this->Number->toPercentage($payDone,1,['multiply' => true]); ?></h2>
                </div>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Payments',
                    'action' => 'index',
                    'prefix' => false],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Your Payments</span>
                        <span class="pull-right"><i class="fal fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($application->invoice)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-file-invoice-dollar fa-fw"></i> Invoices on this Application
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                <th><?= __('Sum Value') ?></th>
                                <th><?= __('Received') ?></th>
                                <th><?= __('Balance') ?></th>
                                <th><?= __('Date Created') ?></th>
                            </tr>
                            <tr>
                                <td><?= h($application->invoice->id) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link('<i class="fal fa-eye"></i> View', ['controller' => 'Invoices','action' => 'view', $application->invoice->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                                </td>
                                <td><?= $this->Number->currency($application->invoice->initialvalue,'GBP') ?></td>
                                <td><?= $this->Number->currency($application->invoice->value,'GBP') ?></td>
                                <td><?= $this->Number->currency($application->invoice->balance,'GBP') ?></td>
                                <td><?= $this->Time->i18nFormat($application->invoice->created,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>      
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($application->attendees)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-poll-people fa-fw"></i> Attendees on this Application
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Attendee Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><?= $this->Html->link(__('Link Attendees'), ['controller' => 'Applications', 'action' => 'link', $application->id]) ?></li>
                                <li class="divider"></li>
                                <li><?= $this->Html->link(__('Add Young Person'), ['controller' => 'Attendees', 'action' => 'cub']) ?></li>
                                <li><?= $this->Html->link(__('Add Adult'), ['controller' => 'Attendees', 'action' => 'adult']) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('First Name') ?></th>
                                <th><?= __('Last Name') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                <th><?= __('Role') ?></th>
                                <th><?= __('Modified') ?></th>
                            </tr>
                            <?php foreach ($application->attendees as $attendees): ?>
                                <tr>
                                    <td><?= h($attendees->firstname) ?></td>
                                    <td><?= h($attendees->lastname) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fal fa-cog"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $attendees->has('role') ? $this->Html->link($this->Text->truncate($attendees->role->role,30), ['controller' => 'Roles', 'action' => 'view', $attendees->role->id]) : '' ?></td>
                                    <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>   
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if (!empty($application->notes)) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-edit fa-fw"></i> Application Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Note') ?></th>
                                <th><?= __('Date Modified') ?></th>
                            </tr>
                            <?php foreach ($application->notes as $notes): ?>
                                <tr>
                                    <td><?= h($notes->id) ?></td>
                                    <td><?= $this->Text->autoParagraph($notes->note_text) ?></td>
                                    <td><?= $this->Time->i18nFormat($notes->modified,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>