<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-child fa-fw"></i> All Roles</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    <th><?= $this->Paginator->sort('invested') ?></th>
                    <th><?= $this->Paginator->sort('minor') ?></th>
                    <th><?= $this->Paginator->sort('automated') ?></th>
                </tr>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= $this->Number->format($role->id) ?></td>
                        <td><?= h($role->role) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $role->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $role->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= h($role->invested ? __('Yes') : __('')) ?></td>
                        <td><?= h($role->minor ? __('Yes') : __('')) ?></td>
                        <td><?= h($role->automated ? __('Yes') : __('')) ?></td>
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