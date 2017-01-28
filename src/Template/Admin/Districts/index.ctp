<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-sitemap fa-fw"></i> All Districts</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="sorting"><?= $this->Paginator->sort('id', '#') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('district') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('short_name') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('county') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($districts as $district): ?>
                    <tr>
                        <td><?= h($district->id) ?></td>
                        <td><?= h($district->district) ?></td>
                        <td><?= h($district->short_name) ?></td>
                        <td><?= h($district->county) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('', ['action' => 'view', $district->id], ['title' => __('View'), 'class' => 'btn btn-default fa fa-eye']) ?>
                            <?= $this->Html->link('', ['action' => 'edit', $district->id], ['title' => __('Edit'), 'class' => 'btn btn-default fa fa-pencil']) ?>
                            <?= $this->Form->postLink('', ['action' => 'delete', $district->id], ['confirm' => __('Are you sure you want to delete # {0}?', $district->id), 'title' => __('Delete'), 'class' => 'btn btn-default fa fa-trash-o']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
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
