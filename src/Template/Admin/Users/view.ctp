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
                        'prefix' => 'admin',
                        $user->id],['_full']); ?>">Trigger Password Reset</a>
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
                    <li><?= $this->Html->link(__('Edit User'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'edit', $user->id]) ?></li>
                    <li><?= $this->Html->link(__('Sync Attendee'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'sync', $user->id]) ?></li>
                    <li><?= $this->Html->link(__('Update Capitalisation'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'update', $user->id]) ?></li>
                    <li><?= $this->Form->postLink(__('Delete'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
                    <li class="divider"></li>
                    <li><?= $this->Html->link(__('Add Note'), ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'new_user', $user->id]) ?></li>
                    <li><?= $this->Html->link(__('New App'), ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'add', $user->id]) ?></li>
                    <li><?= $this->Html->link(__('New Inv'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'add', $user->id]) ?></li>
                    <li><?= $this->Html->link(__('New Att'), ['prefix' => 'admin', 'controller' => 'Attendees', 'action' => 'add', $user->id]) ?></li>
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
                <p><?= $user->has('role') ? $this->Html->link($user->role->role, ['prefix' => 'admin', 'controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></p>
                <h5 class="subheader"><?= __('Scoutgroup') ?></h5>
                <p><?= $user->has('scoutgroup') ? $this->Html->link($user->scoutgroup->scoutgroup, ['prefix' => 'admin', 'controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->id]) : '' ?></p>                
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="subheader"><?= __('Created') ?></h5>
                        <p><?= $this->Time->i18nformat($user->created,'dd-MMM-yy HH:mm') ?></p>
                        <h5 class="subheader"><?= __('Modified') ?></h5>
                        <p><?= $this->Time->i18nformat($user->modified,'dd-MMM-yy HH:mm') ?></p>
                        <h5 class="subheader"><?= __('Last Login') ?></h5>
                        <p><?= $this->Time->i18nformat($user->last_login,'dd-MMM-yy HH:mm') ?></p>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="subheader"><?= __('Id') ?></h5>
                        <p><?= $this->Number->format($user->id) ?></p>
                        <h5 class="subheader"><?= __('Auth Role') ?></h5>
                        <p><?= strtoupper($user->authrole); ?></p>
                        <h5 class="subheader"><?= __('Logins') ?></h5>
                        <p><?= $this->Number->format($user->logins) ?></p>
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
<?php if (!empty($user->applications) || !empty($user->attendees) || !empty($user->invoices) || !empty($user->notes) || !empty($user->notifications)): ?>
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
                    <?php if (!empty($user->applications)): ?>
                        <li <?php if (!empty($user->applications)) { echo 'class="active"'; } ?>><a href="#appl-pills" data-toggle="tab"><i class="fa fa-tasks fa-fw"></i> User's Applications</a></li>
                    <?php endif; ?>
                    <?php if (!empty($user->invoices)): ?>
                        <li><a href="#invo-pills" data-toggle="tab"><i class="fa fa-files-o fa-fw"></i> Users's Invoices</a></li>
                    <?php endif; ?>
                    <?php if (!empty($user->attendees)): ?>
                        <li <?php if (empty($user->applications)) { echo 'class="active"'; } ?>>
                            <a href="#att-pills" data-toggle="tab"><i class="fa fa-group fa-fw"></i> User's Attendees</a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($user->notes)): ?>
                        <li><a href="#note-pills" data-toggle="tab"><i class="fa fa-pencil-square-o fa-fw"></i> User Notes</a></li>
                    <?php endif; ?>
                    <?php if (!empty($user->notifications)): ?>
                        <li><a href="#notif-pills" data-toggle="tab"><i class="fa fa-bell fa-fw"></i> User's Notifications</a></li>
                    <?php endif; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade <?php if (!empty($user->applications)) { echo 'in active'; } ?>" id="appl-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= __('Id') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= __('Scoutgroup') ?></th>
                                        <th><?= __('Event') ?></th>
                                        <th><?= __('Section') ?></th>
                                        <th><?= __('Permitholder') ?></th>
                                        <th><?= __('Created') ?></th>
                                        <th><?= __('Modified') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user->applications as $applications): ?>
                                        <tr>
                                            <td><?= h($applications->display_code) ?></td>
                                            <td class="actions">
                                                <div class="dropdown btn-group">
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu " role="menu">
                                                        <li><?= $this->Html->link(__('View'), ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'view', $applications->id]) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'edit', $applications->id]) ?></li>
                                                        <li><?= $this->Form->postLink(__('Delete'), ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?></li>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Html->link(__('Add Note'), ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'new_application', $applications->id]) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td><?= $applications->has('scoutgroup') ? $this->Html->link($this->Text->truncate($applications->scoutgroup->scoutgroup,18), ['prefix' => 'admin', 'controller' => 'Scoutgroups', 'action' => 'view', $applications->scoutgroup->id]) : '' ?></td>
                                            <td><?= $applications->has('event') ? $this->Html->link($this->Text->truncate($applications->event->name,18), ['prefix' => 'admin', 'controller' => 'Events', 'action' => 'view', $applications->event->id]) : '' ?></td>
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
                    <?php if (!empty($user->invoices)): ?>
                        <div class="tab-pane fade" id="invo-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Sum Value') ?></th>
                                            <th><?= __('Received') ?></th>
                                            <th><?= __('Balance') ?></th>
                                            <th><?= __('Date Created') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user->invoices as $invoices): ?>
                                            <tr>
                                                <td><?= h($invoices->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Update'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'regenerate', $invoices->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['prefix' => 'admin', 'controller' => 'Invoices', 'action' => 'delete', $invoices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoices->id)]) ?></li>
                                                            <li class="divider"></li>
                                                            <li><?= $this->Html->link(__('Add Note'), ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'new_invoice', $invoices->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $invoices->has('application') ? $this->Html->link($invoices->application->display_code, ['prefix' => 'admin', 'controller' => 'Applications', 'action' => 'view', $invoices->application->id]) : '' ?></td>
                                                <td><?= $this->Number->currency($invoices->initialvalue,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoices->value,'GBP') ?></td>
                                                <td><?= $this->Number->currency($invoices->balance,'GBP') ?></td>
                                                <td><?= $this->Time->i18nformat($invoices->created,'dd-MMM-yy HH:mm') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($user->attendees)): ?>
                        <div class="tab-pane fade <?php if (empty($user->applications)) { echo 'in active'; } ?>" id="att-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= __('Scoutgroup') ?></th>
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
                                        <?php foreach ($user->attendees as $attendees): ?>
                                            <tr>
                                                <td><?= h($attendees->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['prefix' => 'admin', 'controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin', 'controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['prefix' => 'admin', 'controller' => 'Attendees', 'action' => 'delete', $attendees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendees->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $attendees->has('scoutgroup') ? $this->Html->link($this->Text->truncate($attendees->scoutgroup->scoutgroup,12), ['prefix' => 'admin', 'controller' => 'Scoutgroups', 'action' => 'view', $attendees->scoutgroup->id]) : '' ?></td>
                                                <td><?= $attendees->has('role') ? $this->Html->link($this->Text->truncate($attendees->role->role,10), ['prefix' => 'admin', 'controller' => 'Roles', 'action' => 'view', $attendees->role->id]) : '' ?></td>
                                                <td><?= h($attendees->firstname) ?></td>    
                                                <td><?= h($attendees->lastname) ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->dateofbirth, 'dd-MMM-yy') ?></td>
                                                <td><?= h($attendees->nightsawaypermit) ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->created, 'dd-MMM-yy HH:mm') ?></td>
                                                <td><?= $this->Time->i18nFormat($attendees->modified, 'dd-MMM-yy HH:mm') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($user->notes)): ?>
                        <div class="tab-pane fade" id="note-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <th><?= __('Actions') ?></th>
                                            <th><?= __('Note Text') ?></th>
                                            <th><?= __('Visible') ?></th>
                                            <th><?= __('Invoice') ?></th>
                                            <th><?= __('Application') ?></th>
                                            <th><?= __('Date Modified') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user->notes as $notes): ?>
                                            <tr>
                                                <td><?= h($notes->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View'), ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'view', $notes->id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'edit', $notes->id]) ?></li>
                                                            <li><?= $this->Form->postLink(__('Delete'), ['prefix' => 'admin', 'controller' => 'Notes', 'action' => 'delete', $notes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notes->id)]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $this->Text->autoParagraph($notes->note_text) ?></td>
                                                <td><?= $notes->visible ? __('Yes') : __('No'); ?></td>
                                                <td><?= $notes->has('application') ? $this->Html->link($notes->application->display_code, ['controller' => 'Applications', 'action' => 'view', $notes->application->id]) : '' ?></td>
                                                <td><?= $notes->has('invoice') ? $this->Html->link($notes->invoice->display_code, ['controller' => 'Invoices', 'action' => 'view', $notes->invoice->id]) : '' ?></td>
                                                <td><?= $this->Time->i18nFormat($notes->modified, 'dd-MMM-yy HH:mm') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($user->notifications)): ?>
                        <div class="tab-pane fade" id="notif-pills">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?= h('Notification ID') ?></th>
                                            <th class="actions"><?= __('Actions') ?></th>
                                            <th><?= h('Notification Type') ?></th>
                                            <th><?= h('Source') ?></th>
                                            <th><?= h('Read') ?></th>
                                            <th><?= h('Created') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($user->notifications as $notification): ?>
                                            <tr>
                                                <td><?= $this->Number->format($notification->id) ?></td>
                                                <td class="actions">
                                                    <div class="dropdown btn-group">
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu " role="menu">
                                                            <li><?= $this->Html->link(__('View Notification'), ['prefix' => 'admin','controller' => 'Notifications','action' => 'view', $notification->id]) ?></li>
                                                            <li><?= $this->Html->link(__('View Subject'), ['prefix' => $notification->link_prefix,'controller' => $notification->link_controller,'action' => $notification->link_action, $notification->link_id]) ?></li>
                                                            <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin','controller' => 'Notifications','action' => 'edit', $notification->id]) ?></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?= $notification->has('notificationtype') ? $notification->notificationtype->notification_type : '' ?></td>
                                                <td><?= h($notification->notification_source) ?></td>
                                                <td><?= $notification->new ? __('No') : __('Yes'); ?></td>
                                                <td><?= $this->Time->i18nformat($notification->created,'dd-MMM-yy HH:mm') ?></td>
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