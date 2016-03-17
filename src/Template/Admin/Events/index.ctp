<<<<<<< HEAD
<div class="row">
    <div class="col-lg-12">
        <h3><i class="fa fa-calendar fa-fw"></i> Upcoming Events</h3>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= h('Name') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                        <th><?= h('Start Date') ?></th>
                        <th><?= h('End Date') ?></th>
                        <th><?= h('Last Modified') ?></th>
                        <th><?= h('Venue') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= h($event->name) ?></td>
                        <td class="actions">
                            <div class="dropdown btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " role="menu">
                                    <li><?= $this->Html->link(__('Preview - User View'), ['action' => 'view', $event->id]) ?></li>
                                    <li><?= $this->Html->link(__('Full View - inc Bookings'), ['action' => 'full_view', $event->id]) ?></li>
                                    <li class="divider"></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?></li>
                                </ul>
                            </div>
                        </td>
                        <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
                        <td><?= h($event->location) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                        Showing page <?= $this->Paginator->counter() ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dataTables_paginate paginatior paging_simple_numbers" id="dataTables-example_paginate">
                        <ul class="pagination">
                            <?= $this->Paginator->prev(__('Previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('Next')) ?>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        </div>
=======
<nav class="actions large-2 medium-2 columns" id="actions-sidebar">
    <ul class="side-nav">
        <h3 class="heading"><?= __('Actions') ?></h3>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Discounts'), ['controller' => 'Discounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Discount'), ['controller' => 'Discounts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Applications'), ['controller' => 'Applications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Application'), ['controller' => 'Applications', 'action' => 'add']) ?></li>
    </ul>

    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/admin');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</nav>
<div class="events index large-10 medium-10 columns content">
    <h3><?= __('Events') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('full_name') ?></th>
                <th><?= $this->Paginator->sort('start') ?></th>
                <th><?= $this->Paginator->sort('end') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
            <tr>
                <td><?= $this->Number->format($event->id) ?></td>
                <td><?= h($event->name) ?></td>
                <td><?= h($event->full_name) ?></td>
                <td><?= $this->Time->i18nFormat($event->start, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($event->end, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($event->created, 'dd-MMM-yy HH:mm') ?></td>
                <td><?= $this->Time->i18nFormat($event->modified, 'dd-MMM-yy HH:mm') ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Summary View'), ['action' => 'view', $event->id]) ?>
                    <?= $this->Html->link(__('Complete View'), ['action' => 'full_view', $event->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
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
