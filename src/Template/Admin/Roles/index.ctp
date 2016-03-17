<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-terminal fa-fw"></i> All Roles</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('role') ?></th>
                        <th><?= $this->Paginator->sort('invested') ?></th>
                        <th><?= $this->Paginator->sort('minor') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?= $this->Number->format($role->id) ?></td>
                            <td class="actions">
                                <div class="dropdown btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " role="menu">
                                        <li><?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?></li>
                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]) ?></li>
                                        <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?= h($role->role) ?></td>
                            <td><?= h($role->invested == 1 ? __('Yes') : __('')) ?></td>
                            <td><?= h($role->minor == 1 ? __('Yes') : __('')) ?></td>
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
            </div>
        </div>
=======
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin_index');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="roles index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('role') ?></th>
            <th><?= $this->Paginator->sort('description') ?></th>
            <th><?= $this->Paginator->sort('invested') ?></th>
            <th><?= $this->Paginator->sort('minor') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($roles as $role): ?>
        <tr>
            <td><?= $this->Number->format($role->id) ?></td>
            <td><?= h($role->role) ?></td>
            <td><?= h($role->description) ?></td>
            <td><?= h($role->invested == 1 ? __('Yes') : __('')) ?></td>
            <td><?= h($role->minor == 1 ? __('Yes') : __('')) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $role->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?>
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
