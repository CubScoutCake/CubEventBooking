<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-user     fa-fw"></i> All Users</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('full_name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('scoutgroup_id', 'Scout Group') ?></th>
                        <th><?= $this->Paginator->sort('role_id', 'Role') ?></th>
                        <th><?= $this->Paginator->sort('username') ?></th>
                        <th><?= $this->Paginator->sort('modified', 'Date Modified') ?></th>
                        <th><?= $this->Paginator->sort('authrole', 'Access Level') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Text->truncate($user->full_name,38) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('Update'), ['action' => 'update', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
                                        <li class="divider"></li>
                                        <li><?= $this->Html->link(__('New App'), ['controller' => 'Applications', 'action' => 'add', $user->id]) ?></li>
                                        <li><?= $this->Html->link(__('New Inv'), ['controller' => 'Invoices', 'action' => 'add', $user->id]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= $user->has('scoutgroup') ? $this->Html->link($this->Text->truncate($user->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->id]) : '' ?></td>
                            <td><?= $user->has('role') ? $this->Html->link($this->Text->truncate($user->role->role,18), ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                            <td><?= $this->Text->truncate($user->username,18) ?></td>
                            <td><?= $this->Time->i18nFormat($user->modified, 'dd-MMM-yy HH:mm') ?></td>
                            <td><?= h(strtoupper($user->authrole)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
=======
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="users index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('scoutgroup_id', 'Scout Group') ?></  th>
            <th><?= $this->Paginator->sort('role_id') ?></th>
            <th><?= $this->Paginator->sort('full_name') ?></th>
            <th><?= $this->Paginator->sort('modified', 'Date Modified') ?></th>
            <th><?= $this->Paginator->sort('authrole', 'Access Level') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Text->truncate($user->username,18) ?></td>
            <td><?= $user->has('scoutgroup') ? $this->Html->link($this->Text->truncate($user->scoutgroup->scoutgroup,38), ['controller' => 'Scoutgroups', 'action' => 'view', $user->scoutgroup->id]) : '' ?></td>
            <td><?= $user->has('role') ? $this->Html->link($this->Text->truncate($user->role->role,38), ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
            <td><?= $this->Text->truncate($user->full_name,38) ?></td>
            <td><?= $this->Time->i18nFormat($user->modified, 'dd-MMM-yy HH:mm') ?></td>
            <td><?= h(strtoupper($user->authrole)) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                <?= $this->Html->link(__('New App'), ['controller' => 'Applications', 'action' => 'add', $user->id]) ?>
                <?= $this->Html->link(__('New Inv'), ['controller' => 'Invoices', 'action' => 'add', $user->id]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
>>>>>>> master
    </div>
</div>
