<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h1 class="page-header"><i class="fa fa-tasks fa-fw"></i> Application <?= h($application->display_code) ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6">
        <div class="panel panel-green">
            <div class="panel-body">
                <span><?= __('User') ?>: <?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></span>
                </br>
                <span><?= __('Scoutgroup') ?>: <?= $application->has('scoutgroup') ? $this->Html->link($application->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></span>
                </br>
                <span><?= __('Team') ?>: <?= h($application->section) ?></span>
                </br>
                <span><?= __('Permitholder') ?>: <?= h($application->permitholder) ?></span>

            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6">
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
    <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-tasks fa-fw"></i> Team Emergency Contact Number
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <span class="text-muted">Please complete:</span><h1><?= __('                        ') ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5>When you have completed the above, all partcipants have arrived and you have checked that all details are correct, please hand in to the County Team in the Hall.</h5> 
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <?php if (!empty($application->attendees)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> Attendees on this Application
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Contact Number') ?></th>
                            <th><?= __('Allergies') ?></th>
                        </tr>
                        <?php foreach ($application->attendees as $attendees): ?>
                        <tr>
                            <td><?= h($attendees->firstname) ?> <?= h($attendees->lastname) ?></td> 
                            <td><?= $attendees->has('role') ? $this->Text->truncate($attendees->role->role,10) : '' ?></td>
                            <td><?= $attendees->phone?></td>
                            <td>
                                <?php if (!empty($attendees->allergies)): ?>
                                    <?php foreach ($attendees->allergies as $allergies): ?>
                                        <?= h($allergies->allergy) . ' '?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="row">
                        <table class="table table-hover">
                        <td>
                        <h3>Please include a next of Kin contact number for EVERY adult present, if this is not above.</h3>
                        </td>
                        </table> 
                    </div>
                </div>
            </div>   
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
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
                <table class="table table-condensed">
                    <tr>
                        <th><?= __('Area') ?></th>
                        <th><?= __('Percentage') ?></th>
                        <th><?= __('Detail') ?></th>
                    </tr>
                    <tr>
                        <td><p>Invoice</p></td> 
                        <td><?= $this->Number->toPercentage($invDone,1,['multiply' => true]); ?></td>
                        <td><span class="text-muted"><?= $this->Number->format($invCount); ?> Invoices</span></td>
                    </tr>
                    <tr>
                        <td><p>Cubs</p></td>
                        <td><?= $this->Number->toPercentage($cubsDone,1,['multiply' => true]); ?></td>
                        <td><span class="text-muted"><?= $this->Number->format($attCubs); ?> Cubs of <?= $this->Number->format($invCubs); ?> on Invoice</span></td>
                    </tr>
                    <tr>
                        <td><p>Leaders &amp; YLs</p></td> 
                        <td><?= $this->Number->toPercentage($cubsNotDone,1,['multiply' => true]); ?></td>
                        <td><span class="text-muted"><?= $this->Number->format($attNotCubs); ?> Leaders of <?= $this->Number->format($invNotCubs); ?> on Invoice</span></td>
                    </tr>
                    <tr>
                        <td><p>Payments</p></td>
                        <td><?= $this->Number->toPercentage($payDone,1,['multiply' => true]); ?></td>
                        <td><span class="text-muted"><?= $this->Number->currency($sumPayments,'GBP'); ?> of <?= $this->Number->currency($sumValues,'GBP'); ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <?php if (!empty($application->invoices)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-files-o fa-fw"></i> Invoices on this Application
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Sum Value') ?></th>
                            <th><?= __('Received') ?></th>
                            <th><?= __('Balance') ?></th>
                            <th><?= __('Date Created') ?></th>
                        </tr>
                        <?php foreach ($application->invoices as $invoices): ?>
                        <tr>
                            <td><?= h($invoices->id) ?></td>
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
    <div class="col-xs-12 col-sm-12">
        <?php if (!empty($application->notes)) : ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pencil-square-o fa-fw"></i> Application Notes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-condensed">
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