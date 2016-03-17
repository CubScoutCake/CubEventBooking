<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-tasks fa-fw"></i> Your Applications</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('event_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('user_id') ?></th>
                        <th><?= $this->Paginator->sort('scoutgroup_id') ?></th>
                        <th><?= $this->Paginator->sort('permitholder', 'Permit Holder') ?></th>
                        <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?= h($application->display_code) ?></td>
                        <td><?= $application->has('event') ? $this->Html->link($application->event->name, ['controller' => 'Events', 'action' => 'view', $application->event->id]) : '' ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?></li>
                                    <li class="divider"></li>
                                    <li><?= $this->Html->link(__('Add Inv'), ['controller' => 'Invoices', 'action' => 'generate', $application->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
                        <td><?= $application->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
                        
                        <td><?= h($application->permitholder) ?></td>
                        <td><?= $this->Time->i18nformat($application->created,'dd-MMM-yy HH:mm') ?></td>
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
=======
<nav class="actions large-2 medium-3 columns" id="actions-sidebar">

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="applications index large-10 medium-9 columns content">
    <h3><?= __('Applications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('scoutgroup_id') ?></th>
                <th><?= $this->Paginator->sort('event_id') ?></th>
                <th><?= $this->Paginator->sort('permitholder', 'Permit Holder') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $application): ?>
            <tr>
                <td><?= h($application->display_code) ?></td>
                <td><?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
                <td><?= $application->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
                <td><?= $application->has('event') ? $this->Html->link($application->event->name, ['controller' => 'Events', 'action' => 'view', $application->event->id]) : '' ?></td>
                <td><?= h($application->permitholder) ?></td>
                <td><?= $this->Time->i18nformat($application->created,'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?>
                    <?= $this->Html->link(__('Add Inv'), ['controller' => 'Invoices', 'action' => 'generate', $application->id]) ?>
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

