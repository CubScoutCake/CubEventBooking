<div class="row">
    <div class="col-lg-9 col-md-8">
        <h1 class="page-header"><i class="fa fa-gbp fa-fw"></i> Payment <?= h($payment->id) ?></h1>
    </div>
    <!-- <div class="col-lg-1 col-md-2">
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
    </div> -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-key fa-fw"></i> Payment Information
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($payment->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Value') ?></th>
                            <td><?= $this->Number->currency($payment->value,'GBP') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= $this->Time->i18nformat($payment->created,'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Paid') ?></th>
                            <td><?= $this->Time->i18nformat($payment->paid,'dd-MMM-yy HH:mm') ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Cheque Number') ?></th>
                            <td><?= h($payment->cheque_number) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name on Cheque') ?></th>
                            <td><?= h($payment->name_on_cheque) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Recorded By') ?></th>
                            <td><?= $payment->has('user') ? $this->Html->link($this->Text->truncate($payment->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($payment->invoices)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-calendar fa-fw"></i> Related Invoices
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th><?= __('User') ?></th>
                            <th><?= __('Sum Value') ?></th>
                            <th><?= __('Received') ?></th>
                            <th><?= __('Balance') ?></th>
                            <th><?= __('Date Created') ?></th>
                        </tr>
                        <?php foreach ($payment->invoices as $invoices): ?>
                            <tr>
                                <td><?= $this->Html->link($invoices->display_code, ['controller' => 'Invoices', 'action' => 'view', $invoices->id]) ?></td>
                                <td class="actions">
                                    <div class="dropdown btn-group">
                                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu " role="menu">
                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Invoices', 'prefix' => 'admin', 'action' => 'view', $invoices->id]) ?></li>
                                            <li><?= $this->Html->link(__('Update'), ['controller' => 'Invoices', 'prefix' => 'admin', 'action' => 'regenerate', $invoices->id]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                                <td><?= $invoices->has('user') ? $this->Html->link($this->Text->truncate($invoices->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $invoices->user->id]) : '' ?></td>
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
    </div>
</div>
<?php endif; ?>