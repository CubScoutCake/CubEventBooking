<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-gears fa-fw"></i> Setting Types</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('setting_type') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('description') ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($settingTypes as $settingType): ?>
                    <tr>
                        <td><?= $this->Number->format($settingType->id) ?></td>
                        <td><?= h($settingType->setting_type) ?></td>

                        <td class="actions">
                            <?= $this->Html->link('', ['action' => 'view', $settingType->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['action' => 'edit', $settingType->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['action' => 'delete', $settingType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $settingType->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash-o']) ?>
                        </td>
                        <td><?= h($settingType->description) ?></td>
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
