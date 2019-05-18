<div class="row">
    <div class="col-lg-10 col-md-10">
        <h1 class="page-header"><i class="fal fa-child fa-fw"></i> <?= h($role->role) ?></h1>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <span><strong><?= __('Id') ?></strong>: <?= $this->Number->format($role->id) ?></span>
                <br />
                <span><strong><?= __('Role') ?></strong>: <?= h($role->role) ?></span>
                <br />
                <span><strong><?= __('Invested') ?></strong>: <?= $role->invested ? __('Yes') : __('No'); ?></span>
                <br />
                <span><strong><?= __('Minor') ?></strong>: <?= $role->minor ? __('Yes') : __('No'); ?></span>
                <br />
            </div>
        </div>
    </div>
</div>
<?php if (!empty($role->attendees)): ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fal fa-poll-people fa-fw"></i> Attendees
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Lastname') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th><?= __('Scoutgroup') ?></th>
                        </tr>
                        <?php foreach ($role->attendees as $attendees): ?>
                            <tr>
                                <td><?= h($attendees->firstname) ?></td>
                                <td><?= h($attendees->lastname) ?></td>
                                <td class="actions">
                                    <div class="dropdown btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fal fa-cog"></i>  <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu " role="menu">
                                            <li><?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendees->id]) ?></li>
                                            <li><?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendees->id]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                                <td><?= $attendees->has('scoutgroup') ? $this->Html->link($attendees->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $attendees->scoutgroup->id]) : '' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>