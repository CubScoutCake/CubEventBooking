<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-cubes fa-fw"></i> Item Types</h3>
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
                </tr>
                </thead>
                <tbody>
                <?php foreach ($itemTypes as $itemType): ?>
                    <tr>
                        <td><?= $this->Number->format($itemType->id) ?></td>
                        <td><?= h($itemType->item_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('', ['action' => 'view', $itemType->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['action' => 'edit', $itemType->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['action' => 'delete', $itemType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemType->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash-o']) ?>
                        </td>
                        <td><?= $itemType->has('role') ? $this->Html->link($itemType->role->role, ['controller' => 'Roles', 'action' => 'view', $itemType->role->id]) : '' ?></td>
                        <td><?= $itemType->minor ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $itemType->cancelled ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $itemType->available ? '<i class="fa fa-check fa-fw"></i>' : '' ?></td>
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
