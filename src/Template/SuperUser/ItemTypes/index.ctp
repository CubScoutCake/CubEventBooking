<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-cubes fa-fw"></i> Item Types</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('item_type') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('minor') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('cancelled') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('available') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('deposit') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('team_price') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($itemTypes as $itemType): ?>
                    <tr>
                        <td><?= $this->Number->format($itemType->id) ?></td>
                        <td><?= h($itemType->item_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $itemType->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $itemType->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $itemType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemType->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $itemType->has('role') ? $this->Html->link($itemType->role->role, ['controller' => 'Roles', 'action' => 'view', $itemType->role->id]) : '' ?></td>
                        <td><?= $itemType->minor ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $itemType->cancelled ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $itemType->available ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $itemType->deposit ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $itemType->team_price ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
