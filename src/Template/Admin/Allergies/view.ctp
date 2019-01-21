<div class="row">
    <div class="col-lg-12">
        <h1><i class="fal fa-allergies fa-fw"></i> <?= h($allergy->allergy) ?></h1>
        <hr>
        <h6 class="subheader"><?= __('Description') ?></h6>
        <p><?= h($allergy->description) ?></p>
    </div>
</div>
<?php if (!empty($allergy->attendees)): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fal fa-poll-people fa-fw"></i> Attendees with this Allergy
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><?= __('Application') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                    <th><?= __('User') ?></th>
                                    <th><?= __('Scout Group') ?></th>
                                    <th><?= __('Role') ?></th>
                                    <th><?= __('Created') ?></th>
                                    <th><?= __('Modified') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($allergy->attendees as $attendee): ?>
                                    <tr>
                                        <td><?= h($attendee->full_name) ?></td>
                                        <td class="actions">
                                            <div class="dropdown btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fal fa-cog"></i>  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu " role="menu">
                                                    <li><?= $this->Html->link(__('View'), ['controller' => 'Attendees', 'action' => 'view', $attendee->id]) ?></li>
                                                    <li><?= $this->Html->link(__('Edit'), ['controller' => 'Attendees', 'action' => 'edit', $attendee->id]) ?></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td><?= $attendee->has('user') ? $this->Html->link($this->Text->truncate($attendee->user->full_name,18), ['controller' => 'Users', 'action' => 'view', $attendee->user->id]) : '' ?></td>
                                        <td><?= $attendee->has('scoutgroup') ? $this->Html->link($this->Text->truncate($attendee->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $attendee->scoutgroup->id]) : '' ?></td>
                                        <td><?= $attendee->has('role') ? $this->Html->link($this->Text->truncate($attendee->role->role,18), ['controller' => 'Roles', 'action' => 'view', $attendee->role->id]) : '' ?></td>
                                        <td><?= h($attendee->created) ?></td>
                                        <td><?= h($attendee->modified) ?></td>
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