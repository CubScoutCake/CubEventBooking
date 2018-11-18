<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-paw fa-fw"></i> All Scout Groups</h3>
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
                                    <i class="fal fa-cog"></i>  <span class="caret"></span>
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

