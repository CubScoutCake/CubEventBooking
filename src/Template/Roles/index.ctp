<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-child fa-fw"></i> All Roles</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th><?= $this->Paginator->sort('invested') ?></th>
                    <th><?= $this->Paginator->sort('minor') ?></th>
                </tr>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= $this->Number->format($role->id) ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= h($role->role) ?></td>
                        <td><?= h($role->invested == 1 ? __('Yes') : __('')) ?></td>
                        <td><?= h($role->minor == 1 ? __('Yes') : __('')) ?></td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
        <div class="pagination">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>