<div class="row">
    <div class="col-lg-12">
        <h3><i class="fal fa-unlock fa-fw"></i> Password States</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('password_state') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('expired') ?></th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($passwordStates as $passwordState): ?>
                    <tr>
                        <td><?= $this->Number->format($passwordState->id) ?></td>
                        <td><?= h($passwordState->password_state) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('<i class="fal fa-eye"></i>', ['action' => 'view', $passwordState->id], ['title' => __('View'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Html->link('<i class="fal fa-pencil"></i>', ['action' => 'edit', $passwordState->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fal fa-trash-alt"></i>', ['action' => 'delete', $passwordState->id], ['confirm' => __('Are you sure you want to delete # {0}?', $passwordState->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-sm', 'escape' => false]) ?>
                        </td>
                        <td><?= $passwordState->active ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                        <td><?= $passwordState->expired ? '<i class="fal fa-check fa-fw"></i>' : '' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
    </div>
</div>
