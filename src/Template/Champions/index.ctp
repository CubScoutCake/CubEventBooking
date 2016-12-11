<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-life-ring fa-fw"></i> All Champions</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('district_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('firstname') ?></th>
                        <th><?= $this->Paginator->sort('lastname') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($champions as $champion): ?>
                    <tr>
                        <td><?= $champion->has('district') ? $this->Html->link($champion->district->district, ['controller' => 'Districts', 'action' => 'view', $champion->district->id]) : '' ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $champion->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= h($champion->firstname) ?></td>
                        <td><?= h($champion->lastname) ?></td>
                        <td><a href="mailto:<?= h($champion->email) ?>" target="_top"><?= h($champion->email) ?></a></td>
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
