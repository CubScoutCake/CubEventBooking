<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-sitemap fa-fw"></i> All Districts</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="sorting"><?= $this->Paginator->sort('district') ?></th>
                        <th class="sorting"><?= $this->Paginator->sort('county') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($districts as $district): ?>
                    <tr>
                        <td><?= h($district->district) ?></td>
                        <td><?= h($district->county) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $district->id]) ?>
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
=======
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="districts index large-9 medium-8 columns content">
    <h3><?= __('Districts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('district') ?></th>
                <th><?= $this->Paginator->sort('county') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($districts as $district): ?>
            <tr>
                <td><?= $this->Number->format($district->id) ?></td>
                <td><?= h($district->district) ?></td>
                <td><?= h($district->county) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $district->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $district->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $district->id], ['confirm' => __('Are you sure you want to delete # {0}?', $district->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
>>>>>>> master
    </div>
</div>
