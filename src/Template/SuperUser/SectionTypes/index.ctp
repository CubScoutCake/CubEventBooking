<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-free-code-camp fa-fw"></i> Section Types</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('section_type') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('upper_age') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lower_age') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sectionTypes as $sectionType): ?>
                    <tr>
                        <td><?= $this->Number->format($sectionType->id) ?></td>
                        <td><?= h($sectionType->section_type) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('', ['action' => 'view', $sectionType->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['action' => 'edit', $sectionType->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['action' => 'delete', $sectionType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sectionType->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash-o']) ?>
                        </td>
                        <td><?= $this->Number->format($sectionType->upper_age) ?></td>
                        <td><?= $this->Number->format($sectionType->lower_age) ?></td>
                        <td><?= $sectionType->has('role') ? $this->Html->link($sectionType->role->role, ['controller' => 'Roles', 'action' => 'view', $sectionType->role->id]) : '' ?></td>
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