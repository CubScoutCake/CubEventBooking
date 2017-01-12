<?= $this->assign('title', 'Herts Cubs - User Home Page'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-dashboard fa-fw"></i> User Home</h1>
        </div>
        <?php if (!empty($events)): ?>
            <div class="col-lg-12">
                <h4>Upcoming Events</h4>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
<?php if (empty($events)): ?>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($countApplications); ?></div>
                        <div>Total Number of Applications</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Applications',
                'action' => 'index',
                'prefix' => false],['_full']); ?>">
                <div class='panel-footer'>
                    <span class='pull-left'>View Your Applications</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-group fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($countAttendees); ?></div>
                        <div>Total Number of Attendees</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Attendees',
                'action' => 'index',
                'prefix' => false],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Your Attendees</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-files-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($countInvoices); ?></div>
                        <div>Total Number of
                            Invoices</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Invoices',
                'action' => 'index',
                'prefix' => false],['_full']); ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Your Invoices</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-gbp fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $this->Number->format($countPayments); ?></div>
                        <div>Total Number of Payments Received</div>
                    </div>
                </div>
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
<?php endif; ?>
<?php if (!empty($events)): ?>
    <?php foreach ($events as $event): ?>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-paw fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div><?= $this->Time->i18nFormat($event->start_date, 'dd-MMM-yy') ?></div>
                            <div class="huge"><?= h($event->name) ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6"
                        <span><?= h($event->location) ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12"
                    <span><?= $this->Time->i18nFormat($event->start_date, 'dd-MMM-yy HH:mm') ?> to <?= $this->Time->i18nFormat($event->end_date, 'dd-MMM-yy HH:mm') ?></span>
                </div>
            </div>
        </div>
        <?php if ($event->new_apps): ?>
            <a href="<?php echo $this->Url->build([
                'controller' => 'Events',
                'action' => 'simpleBook',
                'prefix' => false,
                $event->id],['_full']); ?>">
                <div class='panel-footer'>
                    <span class='pull-left'>Book Onto Event</span>
                    <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                    <div class='clearfix'></div>
                </div>
            </a>
        <?php endif; ?>
        <?php if (!$event->new_apps): ?>
            <div class='panel-footer'>
                <span class='pull-left'>Event not currently accepting bookings.</span>
                <div class='clearfix'></div>
            </div>
        <?php endif; ?>
        </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
    </div>
<?php if (!empty($applications)): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tasks-o fa-fw"></i> Open Applications
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><?= h('Application') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                                <th><?= h('User') ?></th>
                                <th><?= h('Section') ?></th>
                                <th><?= h('Permit Holder') ?></th>
                                <th><?= h('Last Modified') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($applications as $application): ?>
                                <tr>
                                    <td><?= h($application->display_code) ?></td>
                                    <td class="actions">
                                        <div class="dropdown btn-group">
                                            <a href="<?php echo $this->Url->build([
                                                'controller' => 'Applications',
                                                'action' => 'view',
                                                'prefix' => false,
                                                $application->id],['_full']); ?>">
                                                <button type="button" class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i>  <span> View</span>
                                                </button>
                                            </a>
                                            <ul class="dropdown-menu " role="menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $application->id]) ?></li>
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $application->id]) ?></li>
                                                <li class="divider"></li>
                                                <li><?= $this->Html->link(__('Add Note'), ['controller' => 'Notes', 'action' => 'new_application', $application->id]) ?></li>
                                                <li><?= $this->Form->postLink(__('++ Query'), ['controller' => 'Applications','action' => 'query', $application->id], ['confirm' => __('Are you sure you want to query the user of application # {0}?', $application->id)]) ?></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?= $application->has('event') ? $this->Html->link($this->Text->truncate($application->event->name,30), ['controller' => 'Events', 'action' => 'view', $application->event->id]) : '' ?></td>
                                    <td><?= $application->has('section') ? $this->Html->link($this->Text->truncate($application->section->section,30), ['controller' => 'Sections', 'action' => 'view', $application->section->id]) : '' ?></td>
                                    <td><?= $this->Text->truncate($application->permitholder,18) ?></td>
                                    <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></td>
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