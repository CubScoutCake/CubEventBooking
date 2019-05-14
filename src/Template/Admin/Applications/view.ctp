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
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-success dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><?= $this->Html->link(__('Edit Application'), ['controller' => 'Applications', 'action' => 'edit', 'prefix' => 'admin', $application->id]) ?></li>
                    <li><?= $this->Html->link(__('Link Attendees'), ['controller' => 'Applications', 'action' => 'link', 'prefix' => 'admin', $application->id]) ?></li>
                    <li><?= $this->Html->link(__('Download Application'), ['controller' => 'Applications', 'action' => 'view', '_ext' => 'pdf', 'prefix' => 'admin', $application->id]) ?></li>
                    <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $application->id, 'prefix' => 'admin'], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?></li>
                    <li class='divider'></li>
                    <li><a href="<?php 
                        if ($invDone < 0.5) :
                            echo $this->Url->build([
                            'controller' => 'Invoices',
                            'action' => 'generate',
                            'prefix' => 'admin',
                            $application->id],['_full']); ?>">Add an Invoice

                        <?php else : 
                            echo $this->Url->build([
                            'controller' => 'Invoices',
                            'action' => 'regenerate',
                            'prefix' => 'admin',
                            $application->invoice->id],['_full']); ?>">Update Invoice

                        <?php endif ?></a></li>
                    <li><?= $this->Html->link(__('Add Note'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'new_application', $application->id]) ?></li>
                </ul>
            </div>
        </div>
        </br>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></span>
                </br>
                <span><?= __('District') ?>: <?= $application->section->scoutgroup->has('district') ? $this->Html->link($application->section->scoutgroup->district->district, ['controller' => 'Scoutgroups', 'action' => 'view', $application->section->scoutgroup->district->id]) : '' ?></span>
                </br>
                <span><?= __('Scout Group') ?>: <?= $application->section->has('scoutgroup') ? $this->Html->link($application->section->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $application->section->scoutgroup->id]) : '' ?></span>
                </br>
                <span><?= __('Section') ?>: <?= $application->has('section') ? $this->Html->link($application->section->section, ['controller' => 'Sections', 'action' => 'view', $application->section->id]) : '' ?></span>
                </br>
                <span><?= __('Permitholder') ?>: <?= h($application->permit_holder) ?></span>

            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('Event') ?>: <?= $application->has('event') ? $this->Html->link($application->event->full_name, ['controller' => 'Events', 'action' => 'view', $application->event->id]) : '' ?></span>
                </br>
                <span><?= __('App Number') ?>: <?= $this->Number->format($application->id) ?></span>
                </br>
                <span><?= __('Date Created') ?>: <?= $this->Time->i18nFormat($application->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></span>
                </br>
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
                            </br>
                            <span class="pull-right text-muted"><?= $this->Number->format($invCount); ?> <?php if ($invCount == 1) : ?>Invoice<?php else : ?>Invoices<?php endif ?></span>
                            </br>
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
                        'prefix' => 'admin',
                        $application->id],['_full']); ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Generate a New Invoice</span>

                    <?php else : 
                        echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'regenerate',
                        'prefix' => 'admin',
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
                            </br>
                            <span class="pull-right text-muted"><?= $this->Number->format($attCubs); ?> Cubs of <?= $this->Number->format($invCubs); ?> on Invoice</span>
                            </br>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo ($cubsDone * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?>">
                                <span class="sr-only"><?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?> Complete</span>
                            </div>
                        </div>
                    </div>
                    <h2><?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?></h2>
                </div>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Attendees',
                    'action' => 'add',
                    'prefix' => 'admin'],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Add a Cub</span>
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
                            </br>
                            <span class="pull-right text-muted"><?= $this->Number->format($attNotCubs); ?> Leaders of <?= $this->Number->format($invNotCubs); ?> on Invoice</span>
                            </br>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo ($cubsNotDone * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?>">
                                <span class="sr-only"><?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?> Complete</span>
                            </div>
                        </div>
                    </div>
                    <h2><?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?></h2>
                </div>
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Attendees',
                    'action' => 'add',
                    'prefix' => 'admin'],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Add an Adult</span>
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
                            </br>
                            <span class="pull-right text-muted"><?= $this->Number->currency($sumPayments,'GBP'); ?> of <?= $this->Number->currency($sumValues,'GBP'); ?></span>
                            </br>
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
                    'prefix' => 'admin'],['_full']); ?>">
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
	                                <?= $this->Html->link('<i class="fal fa-eye"></i>', ['controller' => 'Invoices', 'action' => 'view', $application->invoice->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
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
                                <th><?= __('Group') ?></th>
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
                                                <li><?= $this->Html->link(__('Update Caps'), ['controller' => 'Attendees', 'action' => 'update', $attendees->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendees', 'action' => 'delete', $attendees->id, 'prefix' => 'admin'], ['confirm' => __('Are you sure you want to delete # {0}?', $attendees->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $attendees->has('role') ? $this->Html->link($this->Text->truncate($attendees->role->role,10), ['controller' => 'Roles', 'action' => 'view', $attendees->role->id]) : '' ?></td>
                                    <td><?= $attendees->has('scoutgroup') ? $this->Html->link($this->Text->truncate($attendees->scoutgroup->scoutgroup,10), ['controller' => 'Scoutgroups', 'action' => 'view', $attendees->scoutgroup->id]) : '' ?></td>
                                    <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                </tr>
                                <?php if (!empty($attendees->allergies)): ?>
                                    <?php foreach ($attendees->allergies as $allergies): ?>
                                        <tr class="danger">
                                            <th></th>
                                            <th><?= __('Allergy') ?></th>
                                            <td>
                                                <div class="dropdown btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu " role="menu">
                                                        <li><?= $this->Html->link(__('View'), ['controller' => 'Allergies', 'action' => 'view', $allergies->id]) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td><?= h($allergies->allergy) ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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
                                <th><?= __('Actions') ?></th>
                                <th><?= __('Note') ?></th>
                                <th><?= __('Date Modified') ?></th>
                            </tr>
                            <?php foreach ($application->notes as $notes): ?>
                                <tr>
                                    <td><?= h($notes->id) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fal fa-cog"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'view', $notes->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'edit', $notes->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Notes', 'prefix' => 'admin', 'action' => 'delete', $notes->id], ['confirm' => __('Are you sure you want to delete note # {0}?', $notes->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
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