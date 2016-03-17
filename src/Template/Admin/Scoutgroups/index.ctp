<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-paw fa-fw"></i> All Scout Groups</h3>
        <div class="table-responsive">
            <table class="table table-hover dataTable">
                <thead>
                    <tr>
                        <th class="sorting"><?= $this->Paginator->sort('id', '#') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('scoutgroup', 'Scout Group') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('district_id') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scoutgroups as $scoutgroup): ?>
                    <tr>
                        <td><?= $this->Number->format($scoutgroup->id) ?></td>
                        <td><?= h($scoutgroup->scoutgroup) ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $scoutgroup->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
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

=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="scoutgroups index large-9 medium-8 columns content">
    <h3><?= __('Scoutgroups') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('scoutgroup') ?></th>
                <th><?= $this->Paginator->sort('district_id') ?></th>
                <th><?= $this->Paginator->sort('number_stripped') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scoutgroups as $scoutgroup): ?>
            <tr>
                <td><?= $this->Number->format($scoutgroup->id) ?></td>
                <td><?= h($scoutgroup->scoutgroup) ?></td>
                <td><?= $scoutgroup->has('district') ? $this->Html->link($scoutgroup->district->district, ['controller' => 'Districts', 'action' => 'view', $scoutgroup->district->id]) : '' ?></td>
                <td><?= $this->Number->format($scoutgroup->number_stripped) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $scoutgroup->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $scoutgroup->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $scoutgroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scoutgroup->id)]) ?>
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
    </div>
</div>
>>>>>>> master
