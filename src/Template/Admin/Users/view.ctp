<div class="row">
    <div class="col-lg-6 col-md-6">
        <h3><i class="fa fa-user fa-fw"></i> View User: <?= h($user->full_name); ?></h3>
    </div>
    <div class="col-lg-3 col-md-3">
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
                        'controller' => 'Applications',
                        'action' => 'index',
                        'prefix' => false],['_full']); ?>">++ Trigger Password Reset</a>
                    </li>
                </ul>
            </div>
        </div>
        </br>
    </div>
    <div class="col-lg-3 col-md-3">
        </br>
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-primary dropdown-toggle" data-toggle="dropdown">
                    Actions
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'index',
                        'prefix' => false],['_full']); ?>">Action</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'index',
                        'prefix' => false],['_full']); ?>">Another action</a>
                    </li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'index',
                        'prefix' => false],['_full']); ?>">Something else here</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $this->Url->build([
                        'controller' => 'Applications',
                        'action' => 'index',
                        'prefix' => false],['_full']); ?>">Separated link</a>
                    </li>
                </ul>
            </div>
        </div>
        </br>
    </div>
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
