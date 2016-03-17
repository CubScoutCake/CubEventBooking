
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-group fa-fw"></i> Your Attendees</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('firstname') ?></th>
                        <th><?= $this->Paginator->sort('lastname') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('scoutgroup_id', 'Scout Group') ?></th>
                        <th><?= $this->Paginator->sort('role_id', 'Role Type') ?></th>
                        <th><?= $this->Paginator->sort('dateofbirth', 'D.O.B.') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($attendees as $attendee): ?>
                    <tr>
                        <td><?= $this->Number->format($attendee->id) ?></td>
                        <td><?= h($attendee->firstname) ?></td>
                        <td><?= h($attendee->lastname) ?></td>
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
                        <td><?= $attendee->has('scoutgroup') ? $this->Html->link($attendee->scoutgroup->scoutgroup, ['controller' => 'Scoutgroups', 'action' => 'view', $attendee->scoutgroup->id]) : '' ?></td>
                        <td><?= $attendee->has('role') ? $this->Html->link($attendee->role->role, ['controller' => 'Roles', 'action' => 'view', $attendee->role->id]) : '' ?></td>
                        <td><?= $this->Time->i18nformat($attendee->dateofbirth,'dd-MMM-yyyy') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                        Showing page <?= $this->Paginator->counter() ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_paginate paginatior paging_simple_numbers" id="dataTables-example_paginate">
                        <ul class="pagination">
                            <?= $this->Paginator->prev(__('Previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('Next')) ?>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
