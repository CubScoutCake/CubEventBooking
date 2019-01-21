<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h1 class="page-header"><i class="fal fa-clipboard-list fa-fw"></i> Application <?= h($application->display_code) ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $application->has('user') ? $application->user->full_name : '' ?></span>
                </br>
                <span><?= __('Scoutgroup') ?>: <?= $application->has('scoutgroup') ? $application->scoutgroup->scoutgroup : '' ?></span>
                </br>
                <span><?= __('Section') ?>: <?= h($application->section) ?></span>
                </br>
                <span><?= __('Permitholder') ?>: <?= h($application->permitholder) ?></span>

            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('Event') ?>: <?= $application->has('event') ? $application->event->full_name : '' ?></span>
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
    <div class="col-sm-12 col-xs-12">
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
    <div class="col-xs-6 col-sm-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <i class="fal fa-file-invoice-dollar"></i> Invoices
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
        </div>
    </div>
    <div class="col-xs-6 col-sm-6">
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
        </div>
    </div>
    <div class="col-xs-6 col-sm-6">
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
        </div>
    </div>
    <div class="col-xs-6 col-sm-6">
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
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <?php if (!empty($application->invoices)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-file-invoice-dollar fa-fw"></i> Invoices on this Application
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Sum Value') ?></th>
                            <th><?= __('Received') ?></th>
                            <th><?= __('Balance') ?></th>
                            <th><?= __('Date Created') ?></th>
                        </tr>
                        <?php foreach ($application->invoices as $invoices): ?>
                        <tr>
                            <td><?= h($invoices->id) ?></td>
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
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <?php if (!empty($application->attendees)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-poll-people fa-fw"></i> Attendees on this Application
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Group') ?></th>
                            <th><?= __('Modified') ?></th>
                        </tr>
                        <?php foreach ($application->attendees as $attendees): ?>
                            <tr>
                                <td><?= h($attendees->firstname) ?></td>
                                <td><?= h($attendees->lastname) ?></td>
                                <td><?= $attendees->has('role') ? $this->Text->truncate($attendees->role->role,10) : '' ?></td>
                                <td><?= $attendees->has('scoutgroup') ? $this->Text->truncate($attendees->scoutgroup->scoutgroup,10) : '' ?></td>
                                <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>
                            </tr>
                            <?php if (!empty($attendees->allergies)): ?>
                                <?php foreach ($attendees->allergies as $allergies): ?>
                                    <tr class="danger">
                                        <th></th>
                                        <th><?= __('Allergy') ?></th>
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
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <?php if (!empty($application->notes)) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fal fa-edit fa-fw"></i> Application Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Note') ?></th>
                            <th><?= __('Date Modified') ?></th>
                        </tr>
                        <?php foreach ($application->notes as $notes): ?>
                            <tr>
                                <td><?= h($notes->id) ?></td>
                                <td><?= $this->Text->autoParagraph($notes->note_text) ?></td>
                                <td><?= $this->Time->i18nformat($notes->modified,'dd-MMM-yy HH:mm') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>