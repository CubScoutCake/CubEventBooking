<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-chevron-circle-down fa-fw"></i> All Discounts</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= $this->Paginator->sort('discount') ?></th>
                        <th><?= $this->Paginator->sort('text') ?></th>
                        <th><?= $this->Paginator->sort('active') ?></th>
                        <th><?= $this->Paginator->sort('discount_value') ?></th>
                        <th><?= $this->Paginator->sort('discount_number') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($discounts as $discount): ?>
                    <tr>
                        <td><?= $this->Number->format($discount->id) ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $discount->id]) ?></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $discount->id]) ?></li>
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $discount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $discount->id)]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= h($discount->discount) ?></td>
                        <td><?= $this->Text->truncate($discount->text,18) ?></td>
                        <td><?= h($discount->active) ?></td>
                        <td><?= $this->Number->currency($discount->discount_value,'GBP') ?></td>
                        <td><?= $this->Number->format($discount->discount_number) ?></td>
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
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Discount'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="discounts index large-10 medium-9 columns content">
    <h3><?= __('Discounts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('discount') ?></th>
                <th><?= $this->Paginator->sort('text') ?></th>
                <th><?= $this->Paginator->sort('active') ?></th>
                <th><?= $this->Paginator->sort('discount_value') ?></th>
                <th><?= $this->Paginator->sort('discount_number') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($discounts as $discount): ?>
            <tr>
                <td><?= $this->Number->format($discount->id) ?></td>
                <td><?= h($discount->discount) ?></td>
                <td><?= $this->Text->truncate($discount->text,18) ?></td>
                <td><?= h($discount->active) ?></td>
                <td><?= $this->Number->currency($discount->discount_value,'GBP') ?></td>
                <td><?= $this->Number->format($discount->discount_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $discount->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $discount->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $discount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $discount->id)]) ?>
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
