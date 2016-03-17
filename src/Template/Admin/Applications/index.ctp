<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-tasks fa-fw"></i> All Applications</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Application') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('User') ?></th>
                        <th><?= $this->Paginator->sort('Scoutgroup') ?></th>
                        <th><?= $this->Paginator->sort('Section') ?></th>
                        <th><?= $this->Paginator->sort('permitholder') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $application): ?>
                        <tr>
                            <td><?= h($application->display_code) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?></li>
                                        <li class="divider"></li>
                                        <li><?= $this->Form->postLink(__('Query'), ['action' => 'query', $application->id], ['confirm' => __('Are you sure you want to query the user of application # {0}?', $application->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
                            <td><?= $application->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
                            <td><?= h($application->section) ?></td>
                            <td><?= $this->Text->truncate($application->permitholder,18) ?></td>
                            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></td>
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
<div class="applications index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Application') ?></th>
            <th><?= $this->Paginator->sort('User') ?></th>
            <th><?= $this->Paginator->sort('Scoutgroup') ?></th>
            <th><?= $this->Paginator->sort('Section') ?></th>
            <th><?= $this->Paginator->sort('permitholder') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($applications as $application): ?>
        <tr>
            <td><?= h($application->display_code) ?></td>
            <td><?= $application->has('user') ? $this->Html->link($application->user->full_name, ['controller' => 'Users', 'action' => 'view', $application->user->id]) : '' ?></td>
            <td><?= $application->has('scoutgroup') ? $this->Html->link($this->Text->truncate($application->scoutgroup->scoutgroup,18), ['controller' => 'Scoutgroups', 'action' => 'view', $application->scoutgroup->id]) : '' ?></td>
            <td><?= h($application->section) ?></td>
            <td><?= $this->Text->truncate($application->permitholder,18) ?></td>
            <td><?= $this->Time->i18nFormat($application->modified, 'dd-MMM-yy HH:mm') ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
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
