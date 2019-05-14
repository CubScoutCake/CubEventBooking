<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fal fa-paw fa-fw"></i> <?= h($scoutgroup->scoutgroup); ?></h1>
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
                        'controller' => 'Scoutgroups',
                        'action' => 'edit',
                        'prefix' => 'admin',
                        $scoutgroup->id],['_full']); ?>">Edit Scout Group</a>
                    </li>
                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $scoutgroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroup->id)]) ?></li>
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
                <i class="fal fa-key fa-fw"></i> Scout Group Info
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <h5 class="subheader"><?= __('Scout Group') ?></h5>
                <p><?= h($scoutgroup->scoutgroup) ?></p>
                <h5 class="subheader"><?= __('District') ?></h5>
                <p><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></p>               
            </div>
            <div class="panel-footer">          
                <h5 class="subheader"><?= __('Id') ?></h5>
                <p><?= $this->Number->format($scoutgroup->id) ?></p>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($scoutgroup->users) || !empty($scoutgroup->attendees) || !empty($scoutgroup->applications)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fal fa-level-down fa-fw"></i> Related Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <?php if (!empty($scoutgroup->users)): ?>
                    <li class="active">
                        <a href="#user-pills" data-toggle="tab"><i class="fal fa-user-circle fa-fw"></i> Users</a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($scoutgroup->applications)): ?>
                        <li><a href="#appl-pills" data-toggle="tab"><i class="fal fa-clipboard-list fa-fw"></i> Applications</a></li>
                    <?php endif; ?>
                    <?php if (!empty($scoutgroup->attendees)): ?>
                        <li><a href="#att-pills" data-toggle="tab"><i class="fal fa-poll-people fa-fw"></i> Attendees</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <?php if (!empty($scoutgroup->users)): ?>
                        <div class="tab-pane fade in fade-in active" id="user-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Full Name') ?></th>
                                            <th><?= __('Email') ?></th>
                                            <th><?= __('Role') ?></th>
                                            <th><?= __('Last Login') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($scoutgroup->users as $users): ?>
                                            <tr>
                                                <td><?= h($users->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= h($users->full_name) ?></td>
                                                <td><?= $this->Text->autolink($users->email) ?></td>
                                                <td><?= $users->has('role') ? $this->Html->link($users->role->role, ['controller' => 'Roles', 'action' => 'view', $users->role->id]) : '' ?></td>
                                                <td><?= $this->Time->i18nFormat($users->modified,'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($scoutgroup->applications)): ?>
                        <div class="tab-pane fade" id="appl-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('User') ?></th>
                                            <th><?= __('Event') ?></th>
                                            <th><?= __('Section') ?></th>
                                            <th><?= __('Permitholder') ?></th>
                                            <th><?= __('Created') ?></th>
                                            <th><?= __('Modified') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($scoutgroup->applications as $applications): ?>
                                            <tr>
                                                <td><?= h($applications->display_code) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $applications->has('user') ? $this->Html->link($this->Text->truncate($applications->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $applications->user->id]) : '' ?></td>
                                                <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
                                                <td><?= h($applications->section) ?></td>
                                                <td><?= h($applications->permitholder) ?></td>
                                                <td><?= h($applications->created) ?></td>
                                                <td><?= h($applications->modified) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($scoutgroup->attendees)): ?>
                        <div class="tab-pane fade" id="att-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('User') ?></th>
                                            <th><?= __('Role') ?></th>
                                            <th><?= __('Firstname') ?></th>
                                            <th><?= __('Lastname') ?></th>
                                            <th><?= __('Dateofbirth') ?></th>
                                            <th><?= __('N.A.P.') ?></th>
                                            <th><?= __('Created') ?></th>
                                            <th><?= __('Modified') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($scoutgroup->attendees as $attendees): ?>
                                            <tr>
                                                <td><?= h($attendees->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendees', 'action' => 'delete', $attendees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendees->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $attendees->has('user') ? $this->Html->link($this->Text->truncate($attendees->user->full_name,12), ['controller' => 'Users', 'action' => 'view', $attendees->user->id]) : '' ?></td>
                                                <td><?= $attendees->has('role') ? $this->Html->link($this->Text->truncate($attendees->role->role,10), ['controller' => 'Roles', 'action' => 'view', $attendees->role->id]) : '' ?></td>
                                                <td><?= h($attendees->firstname) ?></td>    
                                                <td><?= h($attendees->lastname) ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->dateofbirth, 'dd-MMM-yy') ?></td>
                                                <td><?= h($attendees->nightsawaypermit) ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-YY HH:mm', 'Europe/London') ?></td>
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