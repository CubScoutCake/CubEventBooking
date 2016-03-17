<<<<<<< HEAD
<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fa fa-tasks fa-fw"></i> Application <?= h($application->display_code) ?></h1>
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
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'edit',
                        'prefix' => false,
                        $application->id],['_full']); ?>">Edit Application</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Invoices',
                        'action' => 'generate',
                        'prefix' => false,
                        $application->id],['_full']); ?>">Add an Invoice</a>
                    </li>
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
                <span><?= __('User') ?>: <?= $application->has('user') ? $this->Html->link($application->user->username, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></span>
                </br>
                <span><?= __('Scoutgroup') ?>: <?= $application->has('scoutgroup') ? $this->Html->link($application->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></span>
                </br>
                <span><?= __('Section') ?>: <?= h($application->section) ?></span>
                </br>
                <span><?= __('Permitholder') ?>: <?= h($application->permitholder) ?></span>

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
                <span><?= __('Date Created') ?>: <?= $this->Time->i18nFormat($application->created, 'dd-MMM-yy HH:mm') ?></span>
                </br>
                <span><?= __('Last Modified') ?>: <?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-tasks fa-fw"></i> Application Completion Progress
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
                    <i class="fa fa-files-o"></i> Invoices
                </div>
                <div class="panel-body">
                    <div>
                        <p>
                            <strong>Invoice Progress</strong>
                            </br>
                            <span class="pull-right text-muted"><?= $this->Number->format($invCount); ?> Invoices</span>
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
                <a href="<?php echo $this->Url->build([
                    'controller' => 'Invoices',
                    'action' => 'generate',
                    'prefix' => false,
                    $application->id],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Generate a New Invoice</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-group"></i> Attendees
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
                    'action' => 'cub',
                    'prefix' => false],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Add a Cub</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-group"></i> Attendees
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
                    'action' => 'adult',
                    'prefix' => false],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Add an Adult</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <i class="fa fa-gbp"></i> Payments
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
                    'prefix' => false],['_full']); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Your Payments</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="panel-group">
        <div class="col-lg-12">
            <?php if (!empty($application->attendees)): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-group fa-fw"></i> Attendees on this Application
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th><?= __('First Name') ?></th>
                                    <th><?= __('Last Name') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                </tr>
                                <?php foreach ($application->attendees as $attendees): ?>
                                <tr>
                                    <td><?= h($attendees->firstname) ?></td>
                                    <td><?= h($attendees->lastname) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-gear"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?></li>

                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-yy HH:mm') ?></td>
                                    <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>   
            <?php endif; ?>
        </div>
=======
<nav class="actions large-2 medium-3 columns" id="actions-sidebar">
    
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Index'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Young Person'), ['controller' => 'Attendees', 'action' => 'cub']) ?></li>
        <li><?= $this->Html->link(__('New Adult'), ['controller' => 'Attendees', 'action' => 'adult']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="applications view large-10 medium-9 columns content">
    <h3><?= h($application->display_code) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $application->has('user') ? $this->Html->link($application->user->username, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Scoutgroup') ?></th>
            <td><?= $application->has('scoutgroup') ? $this->Html->link($application->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= h($application->section) ?></td>
        </tr>
        <tr>
            <th><?= __('Event') ?></th>
            <td><?= $application->has('event') ? $this->Html->link($application->event->full_name, ['controller' => 'Events', 'action' => 'view', $application->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($application->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Permitholder') ?></th>
            <td><?= h($application->permitholder) ?></td>
        </tr>
        <tr>
            <th><?= __('Date Created') ?></th>
            <td><?= $this->Time->i18nFormat($application->created, 'dd-MMM-yy HH:mm') ?></tr>
        </tr>
        <tr>
            <th><?= __('Last Modified') ?></th>
            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></tr>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Attendees') ?></h4>
        <?php if (!empty($application->attendees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('firstname') ?></th>
                <th><?= __('lastname') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($application->attendees as $attendees): ?>
            <tr>
                <td><?= h($attendees->firstname) ?></td>
                <td><?= h($attendees->lastname) ?></td>
                <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invoices') ?></h4>
        <?php if (!empty($application->invoices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Sum Value') ?></th>
                <th><?= __('Received') ?></th>
                <th><?= __('Balance') ?></th>
                <th><?= __('Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($application->invoices as $invoices): ?>
            <tr>
                <td><?= h($invoices->id) ?></td>
                <td><?= h($invoices->user_id) ?></td>
                <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
                <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
                <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
                <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>

                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoices->id]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
>>>>>>> master
    </div>
</div>
<hr>
<div class="row">
    <div class="panel-group">
        <div class="col-lg-12">
            <?php if (!empty($application->invoices)): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-files-o fa-fw"></i> Invoices on this Application
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                    <th><?= __('User Id') ?></th>
                                    <th><?= __('Sum Value') ?></th>
                                    <th><?= __('Received') ?></th>
                                    <th><?= __('Balance') ?></th>
                                    <th><?= __('Date Created') ?></th>
                                </tr>
                                <?php foreach ($application->invoices as $invoices): ?>
                                <tr>
                                    <td><?= h($invoices->id) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-gear"></i>  <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?></li>
                                                <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoices->id]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= h($invoices->user_id) ?></td>
                                    <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
                                    <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
                                    <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
                                    <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>      
            <?php endif; ?>
        </div>
    </div>
</div>