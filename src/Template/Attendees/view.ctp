<<<<<<< HEAD
<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fa fa-group fa-fw"></i> Attendee Information</h1>
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
                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $attendee->id]) ?></li>
                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendee->id]) ?></li>
                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendee->id)]) ?></li>
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
            <div class="panel-body">
                <h5 class="subheader"><?= __('Full Name') ?></h5>
                <h3><?= h($attendee->full_name) ?></h3>
                <hr>
                <h5 class="subheader"><?= __('Date of Birth (D.O.B.)') ?></h5>
                <p><?= $this->Time->i18nFormat($attendee->dateofbirth, 'dd-MMM-yyyy') ?></p>
                <h5 class="subheader"><?= __('Scoutgroup') ?></h5>
                <p><?= $attendee->has('scoutgroup') ? $this->Html->link($attendee->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $attendee->scoutgroup->id]) : '' ?></p>
                <h5 class="subheader"><?= __('Role') ?></h5>
                <p><?= $attendee->has('role') ? $this->Html->link($attendee->role->role, ['controller' => 'Roles', 'action' => 'view', $attendee->role->id]) : '' ?></p>
                <h5 class="subheader"><?= __('Holds a Nights Away Permit') ?></h5>
                <p><?= $attendee->nightsawaypermit ? __('Yes') : __('No'); ?></p>       
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="subheader"><?= __('Date Record Created') ?></h5>
                        <p><?= $this->Time->i18nFormat($attendee->created, 'dd-MMM-yy HH:mm') ?></p>
                        <h5 class="subheader"><?= __('Date Record Last Modified') ?></h5>
                        <p><?= $this->Time->i18nFormat($attendee->modified, 'dd-MMM-yy HH:mm') ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="subheader"><?= __('Attendee Id') ?></h5>
                        <p><?= $this->Number->format($attendee->id) ?></p>
                        <h5 class="subheader"><?= __('User') ?></h5>
                        <p><?= $attendee->has('user') ? $this->Html->link($attendee->user->full_name, ['controller' => 'Users', 'action' => 'view', $attendee->user->id]) : '' ?></p>
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
            <div class="panel-body">                
                <h5 class="subheader"><?= __('Address') ?></h5>
                <p><?= h($attendee->address_1) ?></p>
                <p><?= h($attendee->address_2) ?></p>
                <p><?= h($attendee->city) ?></p>
                <p><?= h($attendee->county) ?></p>
                <p><?= h($attendee->postcode) ?></p>
            </div>
            <div class="panel-footer">
                <h5 class="subheader"><?= __('Phone') ?></h5>
                <p><?= h($attendee->phone) ?></p>
                <h5 class="subheader"><?= __('Phone 2') ?></h5>
                <p><?= h($attendee->phone2) ?></p>
            </div>
=======
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="attendees view large-10 medium-9 columns">
    <h2>Attendee Information</h2>
    <div class="row">
        <div class="large-5 columns numbers">
            <h6 class="subheader"><?= __('Attendee Id') ?></h6>
            <p><?= $this->Number->format($attendee->id) ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $attendee->has('user') ? $this->Html->link($attendee->user->full_name, ['controller' => 'Users', 'action' => 'view', $attendee->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Scoutgroup') ?></h6>
            <p><?= $attendee->has('scoutgroup') ? $this->Html->link($attendee->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $attendee->scoutgroup->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= $attendee->has('role') ? $this->Html->link($attendee->role->role, ['controller' => 'Roles', 'action' => 'view', $attendee->role->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Holds a Nights Away Permit') ?></h6>
            <p><?= $attendee->nightsawaypermit ? __('Yes') : __('No'); ?></p>
        </div>
        <div class="large-5 columns dates">
            <h6 class="subheader"><?= __('Date of Birth (D.O.B.)') ?></h6>
            <p><?= $this->Time->i18nFormat($attendee->dateofbirth, 'dd-MMM-yyyy') ?></p>
            <h6 class="subheader"><?= __('Date Record Created') ?></h6>
            <p><?= $this->Time->i18nFormat($attendee->created, 'dd-MMM-yy HH:mm') ?></p>
            <h6 class="subheader"><?= __('Date Record Last Modified') ?></h6>
            <p><?= $this->Time->i18nFormat($attendee->modified, 'dd-MMM-yy HH:mm') ?></p>
        </div>
        <div class="large-10 columns">
            </br>
            <h3><?= h($attendee->full_name) ?></h3>
            </br>
        </div>
        <div class="large-10 columns strings end">
            <h6 class="subheader"><?= __('Firstname') ?></h6>
            <p><?= h($attendee->firstname) ?></p>
            <h6 class="subheader"><?= __('Lastname') ?></h6>
            <p><?= h($attendee->lastname) ?></p>
            <h6 class="subheader"><?= __('Phone') ?></h6>
            <p><?= h($attendee->phone) ?></p>
            <h6 class="subheader"><?= __('Phone2') ?></h6>
            <p><?= h($attendee->phone2) ?></p>
            <h6 class="subheader"><?= __('Address 1') ?></h6>
            <p><?= h($attendee->address_1) ?></p>
            <h6 class="subheader"><?= __('Address 2') ?></h6>
            <p><?= h($attendee->address_2) ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= h($attendee->city) ?></p>
            <h6 class="subheader"><?= __('County') ?></h6>
            <p><?= h($attendee->county) ?></p>
            <h6 class="subheader"><?= __('Postcode') ?></h6>
            <p><?= h($attendee->postcode) ?></p>

>>>>>>> master
        </div>
        <?php if (!empty($attendee->allergies)): ?>
            <div class="panel panel-red">
                <div class="panel-heading">
                    <i class="fa fa-exclamation fa-fw"></i> Listed Allergies
                </div>
                <div class="panel-body">                
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?= __('Allergy') ?></th>
                                    <th><?= __('Description') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendee->allergies as $allergies): ?>
                                    <tr>
                                        <td><?= h($allergies->allergy) ?></td>
                                        <td><?= h($allergies->description) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<<<<<<< HEAD
<?php if (!empty($attendee->applications)): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-tasks fa-fw"></i> Applications Attendee is On
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?= __('Application') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                    <th><?= __('Scoutgroup') ?></th>
                                    <th><?= __('Event') ?></th>
                                    <th><?= __('Permitholder') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($attendee->applications as $applications): ?>
                                    <tr>
                                        <td><?= h($applications->display_code) ?></td>
                                        <td class="actions">
                                            <div class="dropdown btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu " role="menu">
                                                    <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
                                                    <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td><?= $applications->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $applications->scoutgroup->id]) : '' ?></td>
                                        <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
                                        <td><?= h($applications->permitholder) ?></td>
                                        <td><?= h($applications->created) ?></td>
                                        <td><?= h($applications->modified) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
=======
        <div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Listed Allergies') ?></h4>
    <?php if (!empty($attendee->allergies)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Allergy') ?></th>
            <th><?= __('Description') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($attendee->allergies as $allergies): ?>
        <tr>
            <td><?= h($allergies->allergy) ?></td>
            <td><?= h($allergies->description) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Allergies', 'action' => 'view', $allergies->id]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Applications') ?></h4>
    <?php if (!empty($attendee->applications)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Application') ?></th>
            <th><?= __('Section') ?></th>
            <th><?= __('Permitholder') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($attendee->applications as $applications): ?>
        <tr>
            <td><?= h($applications->display_code) ?></td>
            <td><?= h($applications->section) ?></td>
            <td><?= h($applications->permitholder) ?></td>
            <td><?= h($applications->created) ?></td>
            <td><?= h($applications->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
>>>>>>> master

