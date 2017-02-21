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
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
            </div>
            <hr>
        </div>
    </div>
</div>

