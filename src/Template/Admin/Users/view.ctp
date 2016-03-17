<<<<<<< HEAD
<div class="row">
    <div class="col-lg-9 col-md-8">
        <h1 class="page-header"><i class="fa fa-user fa-fw"></i> <?= h($user->full_name); ?></h1>
    </div>
    <div class="col-lg-1 col-md-2">
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-success dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o fa-fw"></i>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Notifications',
                        'action' => 'welcome',
                        'prefix' => 'admin',
                        $user->id],['_full']); ?>">Send Welcome Email</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'reset',
                        'prefix' => 'admin'],['_full']); ?>">++ Trigger Password Reset</a>
                    </li>
                </ul>
            </div>
        </div>
        </br>
    </div>
    <div class="col-lg-2 col-md-2">
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Users',
                        'action' => 'edit',
                        'prefix' => 'admin',
                        $user->id],['_full']); ?>">Edit User</a>
                    </li>
                    <li><?= $this->Html->link(__('Update Capitalisation'), ['controller' => 'Users', 'action' => 'update', $user->id]) ?></li>
                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('New App'), ['controller' => 'Applications', 'action' => 'add', $user->id]) ?></li>
                    <li><?= $this->Html->link(__('New Inv'), ['controller' => 'Invoices', 'action' => 'add', $user->id]) ?></li>
                </ul>
            </div>
        </div>
        </br>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-key fa-fw"></i> Key Info
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <h5 class="subheader"><?= __('Username') ?></h5>
                <p><?= h($user->username) ?></p>
                <h5 class="subheader"><?= __('Role') ?></h5>
                <p><?= $user->has('role') ? $this->Html->link($user->role->role, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></p>
                <h5 class="subheader"><?= __('Scoutgroup') ?></h5>
                <p><?= $user->has('scoutgroup') ? $this->Html->link($user->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->id]) : '' ?></p>                
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="subheader"><?= __('Created') ?></h5>
                        <p><?= $this->Time->i18nformat($user->created,'dd-MMM-yy HH:mm') ?></p>
                        <h5 class="subheader"><?= __('Modified') ?></h5>
                        <p><?= $this->Time->i18nformat($user->modified,'dd-MMM-yy HH:mm') ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="subheader"><?= __('Id') ?></h5>
                        <p><?= $this->Number->format($user->id) ?></p>
                        <h5 class="subheader"><?= __('Auth Role') ?></h5>
                        <p><?= strtoupper($user->authrole); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-envelope fa-fw"></i> Contact Info
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <h5 class="subheader"><?= __('Address') ?></h5>
                <p><?= h($user->address_1) ?></p>
                <p><?= h($user->address_2) ?></p>
                <p><?= h($user->city) ?></p>
                <p><?= h($user->county) ?></p>
                <p><?= h($user->postcode) ?></p>
            </div>
            <div class="panel-footer">
                <h5 class="subheader"><?= __('Email') ?></h5>
                <p><?= $this->Text->autoLink($user->email) ?></p>
                <h5 class="subheader"><?= __('Phone') ?></h5>
                <p><?= h($user->phone) ?></p>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($user->applications) || !empty($user->attendees) || !empty($user->invoices)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-level-down fa-fw"></i> Related Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#appl-pills" data-toggle="tab"><i class="fa fa-tasks fa-fw"></i> User's Applications</a>
                    </li>
                    <?php if (!empty($user->invoices)): ?>
                        <li><a href="#invo-pills" data-toggle="tab"><i class="fa fa-files-o fa-fw"></i> Users's Invoices</a></li>
                    <?php endif; ?>
                    <?php if (!empty($user->attendees)): ?>
                        <li><a href="#att-pills" data-toggle="tab"><i class="fa fa-group fa-fw"></i> User's Attendees</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="appl-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th><?= __('Scoutgroup') ?></th>
                                        <th><?= __('Event') ?></th>
                                        <th><?= __('Section') ?></th>
                                        <th><?= __('Permitholder') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th><?= __('Modified') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user->applications as $applications): ?>
                                        <tr>
                                            <td><?= h($applications->display_code) ?></td>
                                            <td><?= $applications->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $applications->scoutgroup->id]) : '' ?></td>
                                            <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
                                            <td><?= h($applications->section) ?></td>
                                            <td><?= h($applications->permitholder) ?></td>
                                            <td><?= h($applications->created) ?></td>
                                            <td><?= h($applications->modified) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?>

                                                <?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?>

                                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if (!empty($user->attendees)): ?>
                        <div class="tab-pane fade" id="invo-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Sum Value') ?></th>
                                            <th><?= __('Received') ?></th>
                                            <th><?= __('Balance') ?></th>
                                            <th><?= __('Date Created') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user->invoices as $invoices): ?>
                                            <tr>
                                                <td><?= h($invoices->id) ?></td>
                                                <td><?= $invoices->has('application') ? $this->Html->link($invoices->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoices->application->id]) : '' ?></td>
                                                <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
                                                <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
                                                <td class="actions">
                                                    <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                                                    <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoices->id]) ?>
                                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($user->attendees)): ?>
                        <div class="tab-pane fade" id="att-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Scoutgroup') ?></th>
                                            <th><?= __('Role') ?></th>
                                            <th><?= __('Firstname') ?></th>
                                            <th><?= __('Lastname') ?></th>
                                            <th><?= __('Dateofbirth') ?></th>
                                            <th><?= __('N.A.P.') ?></th>
                                            <th><?= __('Created') ?></th>
                                            <th><?= __('Modified') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user->attendees as $attendees): ?>
                                            <tr>
                                                <td><?= h($attendees->id) ?></td>
                                                <td><?= $attendees->has('scoutgroup') ? $this->Html->link($this->Text->truncate($attendees->scoutgroup->scoutgroup,12), ['controller' => 'Scoutgroups', 'action' => 'view', $attendees->scoutgroup->id]) : '' ?></td>
                                                <td><?= $attendees->has('role') ? $this->Html->link($this->Text->truncate($attendees->role->role,10), ['controller' => 'Roles', 'action' => 'view', $attendees->role->id]) : '' ?></td>
                                                <td><?= h($attendees->firstname) ?></td>    
                                                <td><?= h($attendees->lastname) ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->dateofbirth, 'dd-MMM-yy') ?></td>
                                                <td><?= h($attendees->nightsawaypermit) ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-yy HH:mm') ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>

                                                <td class="actions">
                                                    <?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?>

                                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?>

                                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendees', 'action' => 'delete', $attendees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendees->id)]) ?>

                                                </td>
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
<?php endif; ?>
=======
<div class="actions columns large-2 medium-3">
    
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Index'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'add', $user->id]) ?></li>
        <li><?= $this->Html->link(__('New Invoice'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'add', $user->id]) ?></li>
        <li><?= $this->Html->link(__('New User'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Form->postLink(__('Delete'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
        <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'edit', $user->id]) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="users view large-10 medium-9 columns">
    <h2><?= h($user->full_name) ?></h2>
    <div class="row">
        <div class="large-6 columns strings">
            <h6 class="subheader"><?= __('Username') ?></h6>
            <p><?= h($user->username) ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= $user->has('role') ? $this->Html->link($user->role->role, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Scoutgroup') ?></h6>
            <p><?= $user->has('scoutgroup') ? $this->Html->link($user->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Firstname') ?></h6>
            <p><?= h($user->firstname) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($user->lastname) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= $this->Text->autoLink($user->email) ?></p>
            <h6 class="subheader"><?= __('Phone') ?></h6>
            <p><?= h($user->phone) ?></p>
        </div>
        <div class="large-2 columns dates">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= $this->Time->i18nformat($user->created,'dd-MMM-yy HH:mm') ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= $this->Time->i18nformat($user->modified,'dd-MMM-yy HH:mm') ?></p>
        </div>
        <div class="large-2 columns numbers">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
            <h6 class="subheader"><?= __('Auth Role') ?></h6>
            <p><?= strtoupper($user->authrole); ?></p>
        </div>
        <div class="large-4 columns end" >
            <p> </p>
        </div>
        <div class="large-4 columns strings end">
            <h6 class="subheader"><?= __('Address 1') ?></h6>
            <p><?= h($user->address_1) ?></p>
            <h6 class="subheader"><?= __('Address 2') ?></h6>
            <p><?= h($user->address_2) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($user->city) ?></p>
            <h6 class="subheader"><?= __('County') ?></h6>
            <p><?= h($user->county) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($user->postcode) ?></p>
            <!--<h6 class="subheader"><?= __('Section') ?></h6>
            <p><?= h($user->section) ?></p>-->
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Applications') ?></h4>
    <?php if (!empty($user->applications)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Scoutgroup') ?></th>
            <th><?= __('Event') ?></th>
            <th><?= __('Section') ?></th>
            <th><?= __('Permitholder') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->applications as $applications): ?>
        <tr>
            <td><?= h($applications->display_code) ?></td>
            <td><?= $applications->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $applications->scoutgroup->id]) : '' ?></td>
            <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
            <td><?= h($applications->section) ?></td>
            <td><?= h($applications->permitholder) ?></td>
            <td><?= h($applications->created) ?></td>
            <td><?= h($applications->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Attendees') ?></h4>
    <?php if (!empty($user->attendees)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Scoutgroup') ?></th>
            <th><?= __('Role') ?></th>
            <th><?= __('Firstname') ?></th>
            <th><?= __('Lastname') ?></th>
            <th><?= __('Dateofbirth') ?></th>
            <th><?= __('N.A.P.') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->attendees as $attendees): ?>
        <tr>
            <td><?= h($attendees->id) ?></td>
            <td><?= $attendees->has('scoutgroup') ? $this->Html->link($this->Text->truncate($attendees->scoutgroup->scoutgroup,12), ['controller' => 'Scoutgroups', 'action' => 'view', $attendees->scoutgroup->id]) : '' ?></td>
            <td><?= $attendees->has('role') ? $this->Html->link($this->Text->truncate($attendees->role->role,10), ['controller' => 'Roles', 'action' => 'view', $attendees->role->id]) : '' ?></td>
            <td><?= h($attendees->firstname) ?></td>    
            <td><?= h($attendees->lastname) ?></td>
            <td><?= $this->Time->i18nFormat($attendees->dateofbirth, 'dd-MMM-yy') ?></td>
            <td><?= h($attendees->nightsawaypermit) ?></td>
            <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-yy HH:mm') ?></td>
            <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendees', 'action' => 'delete', $attendees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendees->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Invoices') ?></h4>
    <?php if (!empty($user->invoices)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Application') ?></th>
            <th><?= __('Sum Value') ?></th>
            <th><?= __('Received') ?></th>
            <th><?= __('Balance') ?></th>
            <th><?= __('Date Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->invoices as $invoices): ?>
        <tr>
            <td><?= h($invoices->id) ?></td>
            <td><?= $invoices->has('application') ? $this->Html->link($invoices->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoices->application->id]) : '' ?></td>
            <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
            <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
            <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
            <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?>
                <?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'action' => 'regenerate', $invoices->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
>>>>>>> master
