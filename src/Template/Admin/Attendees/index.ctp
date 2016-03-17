<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-group fa-fw"></i> All Attendees</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('full_name') ?></th>
                        <th><?= $this->Paginator->sort('user_id') ?></th>
                        <th><?= $this->Paginator->sort('scoutgroup_id') ?></th>
                        <th><?= $this->Paginator->sort('role_id') ?></th>                       
                        <th><?= $this->Paginator->sort('dateofbirth') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendees as $attendee): ?>
                        <tr>
                            <td><?= $this->Number->format($attendee->id) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $attendee->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendee->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendee->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= h($attendee->full_name) ?></td>
                            <td><?= $attendee->has('user') ? $this->Html->link($attendee->user->full_name, ['controller' => 'Users', 'action' => 'view', $attendee->user->id]) : '' ?></td>
                            <td><?= $attendee->has('scoutgroup') ? $this->Html->link($this->Text->truncate($attendee->scoutgroup->scoutgroup,12), ['controller' => 'Scoutgroups', 'action' => 'view', $attendee->scoutgroup->id]) : '' ?></td>
                            <td><?= $attendee->has('role') ? $this->Html->link($this->Text->truncate($attendee->role->role,10), ['controller' => 'Roles', 'action' => 'view', $attendee->role->id]) : '' ?></td>
                            <td><?= $this->Time->i18nFormat($attendee->dateofbirth, 'dd-MMM-yy') ?></td>
                            <td><?= $this->Time->i18nFormat($attendee->modified, 'dd-MMM-yy HH:mm') ?></td>
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
    </div>
</div>
