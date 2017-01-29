<?= $this->assign('title', 'Herts Cubs - Admin Home Page'); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class='fa fa-rocket fa-fw'></i> Admin Home</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>   
    <!-- /.row -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($cntUsers); ?></div>
                        <div>Total Users</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Users',
                'action' => 'index',
                'prefix' => 'admin'],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View All Users</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($cntApplications); ?></div>
                        <div>Total Applications</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
            	'controller' => 'Applications',
            	'action' => 'index',
            	'prefix' => 'admin'],['_full']); ?>">
            	<div class='panel-footer'>
                    <span class='pull-left'>View All Applications</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($cntEvents); ?></div>
                        <div>Total Events</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'action' => 'index',
                'prefix' => 'admin'],['_full']); ?>">
                <div class='panel-footer'>
                    <span class='pull-left'>View All Events</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-files-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($cntInvoices); ?></div>
                        <div>Total Invoices</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
            	'controller' => 'Invoices',
            	'action' => 'index',
            	'prefix' => 'admin'],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View All Invoices</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-gbp fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($cntPayments); ?></div>
                        <div>Total Payments Received</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
            	'controller' => 'Payments',
            	'action' => 'index',
            	'prefix' => 'admin'],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View All Payments</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-group fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($cntAttendees); ?></div>
                        <div>Total Attendees</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Attendees',
                'action' => 'index',
                'prefix' => 'admin'],['_full']); ?>">
                <div class='panel-footer'>
                    <span class='pull-left'>View All Attendees</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                </div>
            </a>
        </div>
    </div>
</div>

<!--<div class="row">
    <div class="col-lg-12">
		<div id="chart-of-actions"></div>
		<script>
			var client = new Keen({
			  projectId: <?php //echo $keenProject;?>,
			  readKey: <?php //echo $keenRead;?>});

				Keen.ready(function(){			  
				  var query = new Keen.Query("count", {
				    eventCollection: "Action",
				    groupBy: [
					    "Action",
					    "Controller"
					],
				    interval: "daily",
				    timeframe: "this_14_days",
				    timezone: "UTC"
				  });
				  
				  client.draw(query, document.getElementById("chart-of-actions"), {
				    // Custom configuration here
				  });
			  
			});


		</script>
	</div>
</div>-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-history fa-fw"></i> Recent Items
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#user-pills" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Recent Users</a>
                    </li>
                    <li>
                        <a href="#appl-pills" data-toggle="tab"><i class="fa fa-tasks fa-fw"></i> Recent Applications</a>
                    </li>
                    <li>
                        <a href="#even-pills" data-toggle="tab"><i class="fa fa-calendar-o fa-fw"></i> Upcoming Events</a>
                    </li>
                    <li>
                        <a href="#invo-pills" data-toggle="tab"><i class="fa fa-files-o fa-fw"></i> Recent Invoices</a>
                    </li>
                    <li>
                        <a href="#paym-pills" data-toggle="tab"><i class="fa fa-gbp fa-fw"></i> Recent Payments</a>
                    </li>
                    <li>
                        <a href="#note-pills" data-toggle="tab"><i class="fa fa-pencil-square-o fa-fw"></i> Recent Notes</a>
                    </li>
                    <li>
                        <a href="#notif-pills" data-toggle="tab"><i class="fa fa-bell fa-fw"></i> Recent Notifications</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="user-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('Full Name') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('Scout Group') ?></th>
                                        <th><?= h('District') ?></th>
                                        <th><?= h('Role') ?></th>
                                        <th><?= h('Username') ?></th>
                                        <th><?= h('Auth Role') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= h($this->Text->truncate($user->full_name,18)) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link('', ['controller' => 'Users', 'action' => 'view', $user->id], ['title' => __('View'), 'class' => 'btn btn-primary fa fa-eye']) ?>
                                            </td>
                                            <td><?= $user->section->has('scoutgroup') ? $this->Html->link($this->Text->truncate($user->section->scoutgroup->scoutgroup,30), ['controller' => 'Scoutgroups', 'action' => 'view', $user->section->scoutgroup->id]) : '' ?></td>
                                            <td><?= $user->section->scoutgroup->has('district') ? $this->Html->link($user->section->scoutgroup->district->short_name, ['controller' => 'Districts', 'action' => 'view', $user->section->scoutgroup->district->id]) : '' ?></td>
                                            <td><?= $user->has('role') ? $this->Html->link($user->role->short_role, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                                            <td><?= h($this->Text->truncate($user->username,18)) ?></td>
                                            <td><?= $user->has('auth_role') ? $this->Html->link($user->auth_role->auth_role, ['controller' => 'AuthRoles', 'action' => 'view', $user->auth_role->id]) : '' ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="appl-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('Application') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('User') ?></th>
                                        <th><?= h('Section') ?></th>
                                        <th><?= h('Scout Group') ?></th>
                                        <th><?= h('District') ?></th>
                                        <th><?= h('Last Modified') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applications as $application): ?>
                                        <tr>
                                            <td><?= h($application->display_code) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link('', ['controller' => 'Applications', 'action' => 'view', $application->id], ['title' => __('View'), 'class' => 'btn btn-success fa fa-eye']) ?>
                                            </td>
                                            <td><?= $application->has('user') ? $this->Html->link($this->Text->truncate($application->user->full_name,30), ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
                                            <td><?= $application->has('section') ? $this->Html->link($this->Text->truncate($application->section->section,30), ['controller' => 'Sections', 'action' => 'view', $application->section->id]) : '' ?></td>
                                            <td><?= $application->section->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->section->scoutgroup->scoutgroup,30), ['controller' => 'Scoutgroups', 'action' => 'view', $application->section->scoutgroup->id]) : '' ?></td>
                                            <td><?= $application->section->scoutgroup->has('district') ? $this->Html->link($this->Text->truncate($application->section->scoutgroup->district->short_name,16), ['controller' => 'Districts', 'action' => 'view', $application->section->scoutgroup->district->id]) : '' ?></td>
                                            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                    <div class="tab-pane fade" id="even-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('Name') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('Start Date') ?></th>
                                        <th><?= h('End Date') ?></th>
                                        <th><?= h('Last Modified') ?></th>
                                        <th><?= h('Venue') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($events as $event): ?>
                                    <tr>
                                        <td><?= h($event->name) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link('', ['controller' => 'Events', 'action' => 'full_view', $event->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                                        </td>
                                        <td><?= $this->Time->i18nFormat($event->start_date, 'dd-MMM-yy HH:mm') ?></td>
                                        <td><?= $this->Time->i18nFormat($event->end_date, 'dd-MMM-yy HH:mm') ?></td>
                                        <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
                                        <td><?= h($event->location) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="invo-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('id') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('User') ?></th>
                                        <th><?= h('Application') ?></th>
                                        <th><?= h('Value') ?></th>
                                        <th><?= h('Received') ?></th>
                                        <th><?= h('Balance') ?></th>
                                        <th><?= h('Date Created') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invoices as $invoice): ?>
                                        <tr>
                                            <td>Invoice #<?= $this->Number->format($invoice->id) ?></td>
                                            <td class="actions">
                                                <div class="dropdown btn-group">
                                                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu " role="menu">
                                                        <li><?= $this->Html->link(__('View'), ['prefix' => 'admin','controller' => 'Invoices','action' => 'view', $invoice->id]) ?></li>
                                                        <li><?= $this->Html->link(__('Update'), ['prefix' => 'admin','controller' => 'Invoices','action' => 'regenerate', $invoice->id]) ?></li>
                                                        <li class="divider"></li>
                                                        <li><?= $this->Html->link(__('Add Note'), ['prefix' => 'admin','controller' => 'Notes','action' => 'new_invoice', $invoice->id]) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td><?= $invoice->has('user') ? $this->Html->link($this->Text->truncate($invoice->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $invoice->user->id]) : '' ?></td>
                                            <td><?= $invoice->has('application') ? $this->Html->link($invoice->application->display_code, ['controller' => 'Applications', 'action' => 'view', $invoice->application->id]) : '' ?></td>
                                            <td><?= $this->Number->currency($invoice->initialvalue,'GBP') ?></td>
                                            <td><?= $this->Number->currency($invoice->value,'GBP') ?></td>
                                            <td><?= $this->Number->currency($invoice->balance,'GBP') ?></td>
                                            <td><?= $this->Time->i18nformat($invoice->created,'dd-MMM-yy HH:mm') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="paym-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('Payment ID') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('Value') ?></th>
                                        <th><?= h('Date Created') ?></th>
                                        <th><?= h('Date Paid') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                        <tr>
                                            <td><?= $this->Number->format($payment->id) ?></td>
                                            <td class="actions">
                                                <div class="dropdown btn-group">
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu " role="menu">
                                                        <li><?= $this->Html->link(__('View'), ['prefix' => 'admin','controller' => 'Payments','action' => 'view', $payment->id]) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin','controller' => 'Payments','action' => 'edit', $payment->id]) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td><?= $this->Number->currency($payment->value,'GBP') ?></td>
                                            <td><?= $this->Time->i18nformat($payment->created,'dd-MMM-yy HH:mm') ?></td>
                                            <td><?= $this->Time->i18nformat($payment->paid,'dd-MMM-yy HH:mm') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="note-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('Note ID') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('Note Text') ?></th>
                                        <th><?= h('User') ?></th>
                                        <th><?= h('Application') ?></th>
                                        <th><?= h('Invoice') ?></th>
                                        <th><?= h('Modified') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notes as $note): ?>
                                        <tr>
                                            <td><?= h($note->id) ?></td>
                                            <td class="actions">
                                                <div class="dropdown btn-group">
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu " role="menu">
                                                        <li><?= $this->Html->link(__('View'), ['prefix' => 'admin','controller' => 'Notes','action' => 'view', $note->id]) ?></li>
                                                        <li><?= $this->Html->link(__('Edit'), ['prefix' => 'admin','controller' => 'Notes','action' => 'edit', $note->id]) ?></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td><?= $this->Text->truncate($note->note_text,50) ?></td>
                                            <td><?= $note->has('user') ? $this->Html->link($this->Text->truncate($note->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $note->user->id]) : '' ?></td>
                                            <td><?= $note->has('application') ? $this->Html->link($note->application->display_code, ['controller' => 'Applications', 'action' => 'view', $note->application->id]) : '' ?></td>
                                            <td><?= $note->has('invoice') ? $this->Html->link($note->invoice->display_code, ['controller' => 'Invoices', 'action' => 'view', $note->invoice->id]) : '' ?></td>
                                            <td><?= $this->Time->i18nformat($note->modified,'dd-MMM-yy HH:mm') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="notif-pills">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><?= h('Notification ID') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                        <th><?= h('User') ?></th>
                                        <th><?= h('Notification Type') ?></th>
                                        <th><?= h('Source') ?></th>
                                        <th><?= h('Read') ?></th>
                                        <th><?= h('Created') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notifications as $notification): ?>
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
                                            <td><?= $notification->has('user') ? $this->Html->link($this->Text->truncate($notification->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $notification->user->id]) : '' ?></td>
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
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>


